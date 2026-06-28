import React from 'react'
import { Link, useLocation } from 'react-router-dom'
import { useAuthStore } from '../../store/authStore'

const NavIcon = ({ path, fill = 'none' }) => (
  <svg width="18" height="18" fill={fill} viewBox="0 0 24 24" stroke="currentColor" strokeWidth="1.8">
    <path strokeLinecap="round" strokeLinejoin="round" d={path} />
  </svg>
)

const ICONS = {
  dashboard: 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
  prompts:   'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z',
  saved:     'M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z',
  reviews:   'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
  profile:   'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z',
  creator:   'M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z',
  admin:     'M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
  add:       'M12 4.5v15m7.5-7.5h-15',
  logout:    'M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75',
}

const navColors = {
  '/dashboard':              { color: '#818cf8', grad: 'linear-gradient(135deg,#4f46e5,#7c3aed)', bg: 'rgba(99,102,241,.16)' },
  '/dashboard/my-prompts':   { color: '#c084fc', grad: 'linear-gradient(135deg,#9333ea,#7e22ce)', bg: 'rgba(168,85,247,.15)' },
  '/dashboard/saved-prompts':{ color: '#38bdf8', grad: 'linear-gradient(135deg,#0284c7,#0891b2)', bg: 'rgba(56,189,248,.14)' },
  '/dashboard/my-reviews':   { color: '#fbbf24', grad: 'linear-gradient(135deg,#d97706,#b45309)', bg: 'rgba(245,158,11,.14)' },
  '/dashboard/profile':      { color: '#34d399', grad: 'linear-gradient(135deg,#059669,#047857)', bg: 'rgba(16,185,129,.13)' },
  '/creator-dashboard':      { color: '#fb7185', grad: 'linear-gradient(135deg,#e11d48,#be123c)', bg: 'rgba(244,63,94,.14)' },
  '/admin-dashboard':        { color: '#fb923c', grad: 'linear-gradient(135deg,#ea580c,#c2410c)', bg: 'rgba(234,88,12,.14)' },
}

export default function Sidebar({ mobileOpen, onClose }) {
  const { user, logout } = useAuthStore()
  const location = useLocation()

  const baseItems = [
    { label: 'Dashboard',     href: '/dashboard',               icon: 'dashboard' },
    { label: 'My Prompts',    href: '/dashboard/my-prompts',    icon: 'prompts'   },
    { label: 'Saved Prompts', href: '/dashboard/saved-prompts', icon: 'saved'     },
    { label: 'My Reviews',    href: '/dashboard/my-reviews',    icon: 'reviews'   },
    { label: 'Profile',       href: '/dashboard/profile',       icon: 'profile'   },
  ]

  const roleItems = user?.role === 'creator'
    ? [{ label: 'Creator Hub',    href: '/creator-dashboard', icon: 'creator' }, ...baseItems]
    : user?.role === 'admin'
    ? [{ label: 'Admin Panel',    href: '/admin-dashboard',   icon: 'admin'   }, ...baseItems]
    : baseItems

  const roleLabel = user?.role === 'admin' ? 'Administrator' : user?.role === 'creator' ? 'Creator' : 'Member'
  const roleBg = user?.role === 'admin' ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : user?.role === 'creator' ? 'linear-gradient(135deg,#9333ea,#7e22ce)' : 'rgba(255,255,255,.1)'

  return (
    <>
      {/* Mobile overlay */}
      {mobileOpen && (
        <div
          className="fixed inset-0 z-40 lg:hidden"
          style={{ background: 'rgba(0,0,0,.6)' }}
          onClick={onClose}
        />
      )}

      <aside
        style={{
          width: 260,
          flexShrink: 0,
          display: 'flex',
          flexDirection: 'column',
          height: '100vh',
          background: '#09101f',
          boxShadow: '4px 0 40px rgba(0,0,0,.55), inset -1px 0 0 rgba(255,255,255,.04)',
          position: 'relative',
          zIndex: 50,
          transition: 'transform .3s cubic-bezier(.16,1,.3,1)',
        }}
        className={`${mobileOpen ? 'translate-x-0' : '-translate-x-full'} lg:translate-x-0 fixed lg:relative top-0 left-0`}
      >
        {/* Brand */}
        <div style={{ display:'flex', alignItems:'center', gap:12, padding:'18px 16px', borderBottom:'1px solid rgba(255,255,255,.05)', flexShrink:0 }}>
          <div style={{ width:38, height:38, borderRadius:12, background:'linear-gradient(135deg,#6366f1,#8b5cf6,#a855f7)', display:'flex', alignItems:'center', justifyContent:'center', boxShadow:'0 4px 18px rgba(99,102,241,.5)' }}>
            <svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2.5">
              <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
            </svg>
          </div>
          <div style={{ flex:1 }}>
            <div style={{ fontSize:15, fontWeight:800, color:'#fff', letterSpacing:'-.3px' }}>PromptHub</div>
            <div style={{ display:'flex', alignItems:'center', gap:5, marginTop:3 }}>
              <span style={{ width:6, height:6, borderRadius:'50%', background:'#34d399', animation:'sb-pulse 2.5s ease infinite', flexShrink:0 }}></span>
              <span style={{ fontSize:9, fontWeight:800, letterSpacing:'.2em', textTransform:'uppercase', color:'rgba(148,163,184,.22)' }}>My Account</span>
            </div>
          </div>
          {mobileOpen && (
            <button onClick={onClose} style={{ width:28, height:28, borderRadius:8, border:'none', background:'rgba(255,255,255,.07)', color:'rgba(255,255,255,.4)', display:'flex', alignItems:'center', justifyContent:'center', cursor:'pointer' }}>
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
          )}
        </div>

        {/* Nav */}
        <nav style={{ flex:1, overflowY:'auto', padding:'8px 0', scrollbarWidth:'thin', scrollbarColor:'rgba(255,255,255,.07) transparent' }}>
          <p style={{ padding:'14px 16px 5px', fontSize:9, fontWeight:800, letterSpacing:'.22em', textTransform:'uppercase', color:'rgba(148,163,184,.18)' }}>Navigation</p>
          {roleItems.map(item => {
            const isActive = location.pathname === item.href
            const nc = navColors[item.href] || { color:'#818cf8', grad:'linear-gradient(135deg,#4f46e5,#7c3aed)', bg:'rgba(99,102,241,.16)' }
            return (
              <Link key={item.href} to={item.href} onClick={onClose}
                style={{
                  display:'flex', alignItems:'center', gap:10,
                  margin:'1px 8px', padding:'9px 10px', borderRadius:10,
                  border: isActive ? '1px solid rgba(255,255,255,.07)' : '1px solid transparent',
                  background: isActive ? nc.bg : 'transparent',
                  textDecoration:'none', transition:'all .15s',
                }}
                onMouseEnter={e => { if (!isActive) { e.currentTarget.style.background='rgba(255,255,255,.04)'; e.currentTarget.style.borderColor='rgba(255,255,255,.05)' }}}
                onMouseLeave={e => { if (!isActive) { e.currentTarget.style.background='transparent'; e.currentTarget.style.borderColor='transparent' }}}
              >
                <div style={{
                  width:34, height:34, borderRadius:9, flexShrink:0,
                  display:'flex', alignItems:'center', justifyContent:'center',
                  background: isActive ? nc.grad : 'rgba(255,255,255,.06)',
                  color: isActive ? '#fff' : 'rgba(148,163,184,.5)',
                  boxShadow: isActive ? '0 4px 14px rgba(0,0,0,.28)' : 'none',
                  transition:'all .15s',
                }}>
                  <NavIcon path={ICONS[item.icon]} />
                </div>
                <span style={{ flex:1, fontSize:13.5, fontWeight: isActive ? 600 : 500, color: isActive ? '#fff' : 'rgba(148,163,184,.6)', transition:'color .15s' }}>
                  {item.label}
                </span>
                {isActive && (
                  <span style={{ width:6, height:6, borderRadius:'50%', background:nc.color, boxShadow:`0 0 8px ${nc.color}`, flexShrink:0 }}></span>
                )}
              </Link>
            )
          })}

          <div style={{ height:1, background:'rgba(255,255,255,.04)', margin:'10px 16px' }}></div>

          {/* Add Prompt CTA */}
          <div style={{ padding:'4px 8px' }}>
            <Link to="/dashboard/add-prompt" onClick={onClose}
              style={{
                display:'flex', alignItems:'center', justifyContent:'center', gap:8,
                padding:'10px 0', borderRadius:10, textDecoration:'none',
                background:'linear-gradient(135deg,#6366f1,#8b5cf6)',
                color:'#fff', fontSize:13.5, fontWeight:700,
                boxShadow:'0 4px 16px rgba(99,102,241,.4)',
                transition:'all .15s',
              }}
              onMouseEnter={e => { e.currentTarget.style.transform='translateY(-1px)'; e.currentTarget.style.boxShadow='0 8px 24px rgba(99,102,241,.5)' }}
              onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 4px 16px rgba(99,102,241,.4)' }}
            >
              <NavIcon path={ICONS.add} />
              Add New Prompt
            </Link>
          </div>
        </nav>

        {/* User footer */}
        <div style={{ padding:10, flexShrink:0, borderTop:'1px solid rgba(255,255,255,.05)' }}>
          <div style={{ display:'flex', alignItems:'center', gap:10, padding:'10px 11px', borderRadius:10, background:'rgba(255,255,255,.035)', border:'1px solid rgba(255,255,255,.055)' }}>
            {user?.photo_url ? (
              <img src={user.photo_url} alt="" style={{ width:36, height:36, borderRadius:'50%', objectFit:'cover', flexShrink:0 }} />
            ) : (
              <div style={{ width:36, height:36, borderRadius:'50%', background:'linear-gradient(135deg,#6366f1,#a855f7)', display:'flex', alignItems:'center', justifyContent:'center', fontSize:14, fontWeight:700, color:'#fff', flexShrink:0, position:'relative' }}>
                {user?.name?.[0]?.toUpperCase() || 'U'}
                <span style={{ position:'absolute', bottom:-1, right:-1, width:11, height:11, borderRadius:'50%', background:'#34d399', border:'2px solid #09101f' }}></span>
              </div>
            )}
            <div style={{ flex:1, minWidth:0 }}>
              <div style={{ fontSize:13, fontWeight:600, color:'#fff', lineHeight:1.1, overflow:'hidden', textOverflow:'ellipsis', whiteSpace:'nowrap' }}>{user?.name || 'User'}</div>
              <div style={{ fontSize:10, color:'rgba(148,163,184,.32)', marginTop:2 }}>
                <span style={{ display:'inline-block', padding:'1px 6px', borderRadius:99, fontSize:9, fontWeight:700, background:roleBg, color:'#fff' }}>{roleLabel}</span>
              </div>
            </div>
            <button
              onClick={logout}
              title="Sign out"
              style={{ width:30, height:30, borderRadius:8, border:'none', background:'transparent', cursor:'pointer', display:'flex', alignItems:'center', justifyContent:'center', color:'rgba(148,163,184,.35)', transition:'all .15s' }}
              onMouseEnter={e => { e.currentTarget.style.background='rgba(239,68,68,.15)'; e.currentTarget.style.color='#f87171' }}
              onMouseLeave={e => { e.currentTarget.style.background='transparent'; e.currentTarget.style.color='rgba(148,163,184,.35)' }}
            >
              <NavIcon path={ICONS.logout} />
            </button>
          </div>
        </div>

        <style>{`
          @keyframes sb-pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.35)} }
        `}</style>
      </aside>
    </>
  )
}
