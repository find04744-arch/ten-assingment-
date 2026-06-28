import React, { useEffect, useState } from 'react'
import { toast } from 'react-toastify'
import { useAuthStore } from '../../store/authStore'
import { userAPI } from '../../api'

const Field = ({ label, type = 'text', name, value, onChange, placeholder, required, hint }) => (
  <div>
    <label style={{ display:'block', fontSize:12, fontWeight:700, color:'#475569', marginBottom:5, letterSpacing:'.01em' }}>{label}{required && <span style={{ color:'#ef4444', marginLeft:3 }}>*</span>}</label>
    {type === 'textarea' ? (
      <textarea
        name={name} value={value} onChange={onChange} placeholder={placeholder} rows={3}
        style={{ width:'100%', padding:'10px 13px', borderRadius:10, border:'1.5px solid #e2e8f0', fontSize:13.5, color:'#1e293b', outline:'none', resize:'vertical', fontFamily:'inherit', boxSizing:'border-box', transition:'border-color .15s' }}
        onFocus={e => e.target.style.borderColor='#6366f1'}
        onBlur={e => e.target.style.borderColor='#e2e8f0'}
      />
    ) : (
      <input
        type={type} name={name} value={value} onChange={onChange} placeholder={placeholder}
        style={{ width:'100%', padding:'10px 13px', borderRadius:10, border:'1.5px solid #e2e8f0', fontSize:13.5, color:'#1e293b', outline:'none', boxSizing:'border-box', transition:'border-color .15s' }}
        onFocus={e => e.target.style.borderColor='#6366f1'}
        onBlur={e => e.target.style.borderColor='#e2e8f0'}
      />
    )}
    {hint && <p style={{ fontSize:11, color:'#94a3b8', marginTop:4 }}>{hint}</p>}
  </div>
)

export default function ProfilePage() {
  const { user, updateUser } = useAuthStore()
  const [saving, setSaving] = useState(false)
  const [pwSaving, setPwSaving] = useState(false)
  const [profile, setProfile] = useState({ name:'', email:'', bio:'', website:'', location:'' })
  const [passwords, setPasswords] = useState({ current_password:'', password:'', password_confirmation:'' })
  const [pwStrength, setPwStrength] = useState(0)
  const [showPw, setShowPw] = useState({ current:false, new:false, confirm:false })

  useEffect(() => {
    userAPI.getProfile()
      .then(res => {
        const d = res.data?.user || res.data || {}
        setProfile({ name: d.name || '', email: d.email || '', bio: d.bio || '', website: d.website || '', location: d.location || '' })
      })
      .catch(() => {
        if (user) setProfile({ name: user.name || '', email: user.email || '', bio: '', website: '', location: '' })
      })
  }, [user])

  const calcStrength = (pw) => {
    let s = 0
    if (pw.length >= 8)  s++
    if (/[A-Z]/.test(pw)) s++
    if (/[0-9]/.test(pw)) s++
    if (/[^A-Za-z0-9]/.test(pw)) s++
    return s
  }

  const strengthLabel = ['', 'Weak', 'Fair', 'Good', 'Strong']
  const strengthColor = ['', '#ef4444', '#f59e0b', '#6366f1', '#10b981']

  const handleProfileChange = e => setProfile(prev => ({ ...prev, [e.target.name]: e.target.value }))

  const handlePwChange = e => {
    const { name, value } = e.target
    setPasswords(prev => ({ ...prev, [name]: value }))
    if (name === 'password') setPwStrength(value ? calcStrength(value) : 0)
  }

  const handleProfileSave = async e => {
    e.preventDefault()
    if (!profile.name.trim()) return toast.error('Name is required')
    setSaving(true)
    try {
      const res = await userAPI.updateProfile(profile)
      const updated = res.data?.user || res.data
      if (updated) updateUser(updated)
      toast.success('Profile updated!')
    } catch (err) {
      toast.error(err?.response?.data?.message || 'Failed to update profile')
    } finally {
      setSaving(false)
    }
  }

  const handlePasswordSave = async e => {
    e.preventDefault()
    if (!passwords.current_password) return toast.error('Current password required')
    if (passwords.password.length < 8) return toast.error('New password must be at least 8 characters')
    if (passwords.password !== passwords.password_confirmation) return toast.error('Passwords do not match')
    setPwSaving(true)
    try {
      await userAPI.updateProfile({ current_password: passwords.current_password, password: passwords.password, password_confirmation: passwords.password_confirmation })
      setPasswords({ current_password:'', password:'', password_confirmation:'' })
      setPwStrength(0)
      toast.success('Password changed!')
    } catch (err) {
      toast.error(err?.response?.data?.message || 'Failed to change password')
    } finally {
      setPwSaving(false)
    }
  }

  const initials = profile.name ? profile.name.split(' ').map(p => p[0]).join('').toUpperCase().slice(0,2) : (user?.name?.[0]?.toUpperCase() || 'U')

  return (
    <div style={{ maxWidth:800, margin:'0 auto' }}>
      <style>{`@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.pf-fade{animation:fadeUp .4s cubic-bezier(.16,1,.3,1) both;}`}</style>

      {/* Header */}
      <div className="pf-fade" style={{ position:'relative', overflow:'hidden', borderRadius:20, marginBottom:22, background:'linear-gradient(135deg,#0c4a6e 0%,#0369a1 55%,#7c3aed 100%)', padding:'28px 28px 24px' }}>
        <div style={{ position:'absolute', top:-40, right:-40, width:200, height:200, borderRadius:'50%', background:'rgba(255,255,255,.05)', pointerEvents:'none' }}></div>
        <div style={{ position:'relative', display:'flex', alignItems:'center', gap:18 }}>
          <div style={{ width:66, height:66, borderRadius:18, background:'linear-gradient(135deg,#6366f1,#a855f7)', display:'flex', alignItems:'center', justifyContent:'center', fontSize:22, fontWeight:900, color:'#fff', boxShadow:'0 6px 20px rgba(99,102,241,.5)', flexShrink:0 }}>
            {user?.photo_url ? <img src={user.photo_url} alt="" style={{ width:'100%', height:'100%', borderRadius:18, objectFit:'cover' }} /> : initials}
          </div>
          <div>
            <p style={{ fontSize:10, fontWeight:700, color:'rgba(186,230,253,.65)', textTransform:'uppercase', letterSpacing:'.2em', marginBottom:4 }}>Account Settings</p>
            <p style={{ fontSize:22, fontWeight:900, color:'#fff', lineHeight:1.2 }}>{profile.name || user?.name || 'Your Profile'}</p>
            <p style={{ fontSize:12, color:'rgba(186,230,253,.55)', marginTop:2 }}>{profile.email || user?.email}</p>
          </div>
        </div>
      </div>

      <div style={{ display:'grid', gap:16 }}>

        {/* Profile Info */}
        <form onSubmit={handleProfileSave} style={{ background:'#fff', borderRadius:18, border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)', overflow:'hidden' }}>
          <div style={{ padding:'18px 22px', borderBottom:'1px solid #f1f5f9', display:'flex', alignItems:'center', gap:10 }}>
            <div style={{ width:30, height:30, borderRadius:8, background:'linear-gradient(135deg,#4f46e5,#7c3aed)', display:'flex', alignItems:'center', justifyContent:'center' }}>
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
            <span style={{ fontSize:14, fontWeight:700, color:'#1e293b' }}>Profile Information</span>
          </div>
          <div style={{ padding:'22px 22px 20px', display:'flex', flexDirection:'column', gap:16 }}>
            <div style={{ display:'grid', gridTemplateColumns:'1fr 1fr', gap:14 }}>
              <Field label="Full Name" name="name" value={profile.name} onChange={handleProfileChange} placeholder="Your full name" required />
              <Field label="Email Address" type="email" name="email" value={profile.email} onChange={handleProfileChange} placeholder="your@email.com" required />
            </div>
            <Field label="Bio" type="textarea" name="bio" value={profile.bio} onChange={handleProfileChange} placeholder="Tell the community about yourself..." hint="A short bio shown on your public profile" />
            <div style={{ display:'grid', gridTemplateColumns:'1fr 1fr', gap:14 }}>
              <Field label="Website" type="url" name="website" value={profile.website} onChange={handleProfileChange} placeholder="https://yoursite.com" />
              <Field label="Location" name="location" value={profile.location} onChange={handleProfileChange} placeholder="City, Country" />
            </div>
            <div style={{ display:'flex', justifyContent:'flex-end', paddingTop:4 }}>
              <button type="submit" disabled={saving}
                style={{ padding:'9px 22px', borderRadius:10, fontSize:13, fontWeight:700, color:'#fff', border:'none', background:'linear-gradient(135deg,#4f46e5,#7c3aed)', cursor:saving ? 'not-allowed' : 'pointer', opacity:saving ? .7 : 1, boxShadow:'0 4px 14px rgba(99,102,241,.35)', transition:'all .15s' }}
                onMouseEnter={e => { if (!saving) { e.currentTarget.style.transform='translateY(-1px)'; e.currentTarget.style.boxShadow='0 8px 22px rgba(99,102,241,.45)' }}}
                onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 4px 14px rgba(99,102,241,.35)' }}
              >
                {saving ? 'Saving...' : 'Save Profile'}
              </button>
            </div>
          </div>
        </form>

        {/* Password */}
        <form onSubmit={handlePasswordSave} style={{ background:'#fff', borderRadius:18, border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)', overflow:'hidden' }}>
          <div style={{ padding:'18px 22px', borderBottom:'1px solid #f1f5f9', display:'flex', alignItems:'center', gap:10 }}>
            <div style={{ width:30, height:30, borderRadius:8, background:'linear-gradient(135deg,#dc2626,#e11d48)', display:'flex', alignItems:'center', justifyContent:'center' }}>
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
            </div>
            <span style={{ fontSize:14, fontWeight:700, color:'#1e293b' }}>Change Password</span>
          </div>
          <div style={{ padding:'22px 22px 20px', display:'flex', flexDirection:'column', gap:14 }}>
            {[
              { label:'Current Password', name:'current', pw:'current_password' },
              { label:'New Password',     name:'new',     pw:'password' },
              { label:'Confirm Password', name:'confirm', pw:'password_confirmation' },
            ].map(({ label, name, pw }) => (
              <div key={name}>
                <label style={{ display:'block', fontSize:12, fontWeight:700, color:'#475569', marginBottom:5 }}>{label}</label>
                <div style={{ position:'relative' }}>
                  <input
                    type={showPw[name] ? 'text' : 'password'}
                    name={pw} value={passwords[pw]} onChange={handlePwChange}
                    placeholder="••••••••"
                    style={{ width:'100%', padding:'10px 40px 10px 13px', borderRadius:10, border:'1.5px solid #e2e8f0', fontSize:13.5, color:'#1e293b', outline:'none', boxSizing:'border-box', transition:'border-color .15s' }}
                    onFocus={e => e.target.style.borderColor='#6366f1'}
                    onBlur={e => e.target.style.borderColor='#e2e8f0'}
                  />
                  <button type="button" onClick={() => setShowPw(prev => ({ ...prev, [name]:!prev[name] }))}
                    style={{ position:'absolute', right:12, top:'50%', transform:'translateY(-50%)', background:'none', border:'none', cursor:'pointer', color:'#94a3b8', display:'flex', alignItems:'center', justifyContent:'center' }}
                  >
                    {showPw[name] ? (
                      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/></svg>
                    ) : (
                      <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    )}
                  </button>
                </div>
                {name === 'new' && passwords.password && (
                  <div style={{ marginTop:6 }}>
                    <div style={{ display:'flex', gap:3, marginBottom:4 }}>
                      {[1,2,3,4].map(i => (
                        <div key={i} style={{ flex:1, height:3, borderRadius:99, background: i <= pwStrength ? strengthColor[pwStrength] : '#e2e8f0', transition:'background .2s' }}></div>
                      ))}
                    </div>
                    <p style={{ fontSize:11, color: strengthColor[pwStrength], fontWeight:600 }}>{strengthLabel[pwStrength]}</p>
                  </div>
                )}
              </div>
            ))}
            <div style={{ display:'flex', justifyContent:'flex-end', paddingTop:4 }}>
              <button type="submit" disabled={pwSaving}
                style={{ padding:'9px 22px', borderRadius:10, fontSize:13, fontWeight:700, color:'#fff', border:'none', background:'linear-gradient(135deg,#dc2626,#e11d48)', cursor:pwSaving ? 'not-allowed' : 'pointer', opacity:pwSaving ? .7 : 1, boxShadow:'0 4px 14px rgba(220,38,38,.35)', transition:'all .15s' }}
                onMouseEnter={e => { if (!pwSaving) e.currentTarget.style.transform='translateY(-1px)' }}
                onMouseLeave={e => e.currentTarget.style.transform='translateY(0)'}
              >
                {pwSaving ? 'Updating...' : 'Update Password'}
              </button>
            </div>
          </div>
        </form>

      </div>
    </div>
  )
}
