import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import { useAuthStore } from '../../store/authStore'
import { userAPI, promptAPI } from '../../api'

const KpiCard = ({ label, value, sub, grad, icon, loading }) => (
  <div style={{ background:'#fff', borderRadius:16, padding:20, border:'1px solid #e5e9f0', boxShadow:'0 2px 14px rgba(0,0,0,.05)', transition:'transform .2s, box-shadow .2s', cursor:'default' }}
    onMouseEnter={e => { e.currentTarget.style.transform='translateY(-3px)'; e.currentTarget.style.boxShadow='0 14px 36px rgba(0,0,0,.09)' }}
    onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 2px 14px rgba(0,0,0,.05)' }}
  >
    <div style={{ display:'flex', alignItems:'center', justifyContent:'space-between', marginBottom:16 }}>
      <div style={{ width:42, height:42, borderRadius:11, background:grad, display:'flex', alignItems:'center', justifyContent:'center', boxShadow:`0 4px 14px rgba(0,0,0,.2)` }}>
        <svg width="19" height="19" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="1.8">
          <path strokeLinecap="round" strokeLinejoin="round" d={icon} />
        </svg>
      </div>
      <span style={{ fontSize:9.5, fontWeight:700, color:'#cbd5e1', textTransform:'uppercase', letterSpacing:'.12em' }}>{label}</span>
    </div>
    {loading ? (
      <div style={{ height:30, borderRadius:6, background:'linear-gradient(90deg,#f1f5f9,#e2e8f0,#f1f5f9)', backgroundSize:'200% 100%', animation:'shimmer 1.5s infinite' }}></div>
    ) : (
      <p style={{ fontSize:28, fontWeight:900, color:'#0f172a', letterSpacing:'-1.5px', lineHeight:1 }}>{value}</p>
    )}
    <p style={{ fontSize:11, color:'#94a3b8', marginTop:5 }}>{sub}</p>
  </div>
)

const QuickAction = ({ to, grad, icon, label, sub }) => (
  <Link to={to} style={{ background:'#fff', borderRadius:16, padding:20, border:'1px solid #e5e9f0', boxShadow:'0 2px 10px rgba(0,0,0,.04)', textDecoration:'none', display:'flex', flexDirection:'column', gap:12, transition:'transform .2s, box-shadow .2s' }}
    onMouseEnter={e => { e.currentTarget.style.transform='translateY(-3px)'; e.currentTarget.style.boxShadow='0 14px 30px rgba(0,0,0,.09)' }}
    onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 2px 10px rgba(0,0,0,.04)' }}
  >
    <div style={{ width:44, height:44, borderRadius:12, background:grad, display:'flex', alignItems:'center', justifyContent:'center', boxShadow:'0 4px 14px rgba(0,0,0,.22)' }}>
      <svg width="21" height="21" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="1.8"><path strokeLinecap="round" strokeLinejoin="round" d={icon}/></svg>
    </div>
    <div>
      <p style={{ fontSize:13.5, fontWeight:700, color:'#1e293b' }}>{label}</p>
      <p style={{ fontSize:11.5, color:'#94a3b8', marginTop:2 }}>{sub}</p>
    </div>
  </Link>
)

export default function UserDashboard() {
  const { user } = useAuthStore()
  const [stats, setStats] = useState(null)
  const [recentPrompts, setRecentPrompts] = useState([])
  const [loading, setLoading] = useState(true)

  const hour = new Date().getHours()
  const greeting = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening'

  useEffect(() => {
    const load = async () => {
      try {
        const [statsRes, promptsRes] = await Promise.allSettled([
          userAPI.getDashboardStats(),
          promptAPI.getUserPrompts(),
        ])
        if (statsRes.status === 'fulfilled') setStats(statsRes.value.data)
        if (promptsRes.status === 'fulfilled') {
          const data = promptsRes.value.data
          setRecentPrompts(Array.isArray(data) ? data.slice(0, 4) : (data?.data?.slice(0, 4) || []))
        }
      } catch {
        // graceful — show zeros
      } finally {
        setLoading(false)
      }
    }
    load()
  }, [])

  const STATUS_STYLE = {
    approved: { bg:'#dcfce7', c:'#065f46' },
    pending:  { bg:'#fef3c7', c:'#92400e' },
    rejected: { bg:'#fee2e2', c:'#991b1b' },
  }

  return (
    <div style={{ maxWidth:1100, margin:'0 auto' }}>
      <style>{`
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
        @keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .dash-fade { animation: fadeUp .4s cubic-bezier(.16,1,.3,1) both; }
        .dash-fade-1 { animation: fadeUp .4s cubic-bezier(.16,1,.3,1) .06s both; }
        .dash-fade-2 { animation: fadeUp .4s cubic-bezier(.16,1,.3,1) .12s both; }
        .dash-fade-3 { animation: fadeUp .4s cubic-bezier(.16,1,.3,1) .18s both; }
      `}</style>

      {/* Hero */}
      <div className="dash-fade" style={{ position:'relative', overflow:'hidden', borderRadius:20, marginBottom:22, background:'linear-gradient(135deg,#0f0724 0%,#1e1060 35%,#2d1b85 65%,#3b1fa3 100%)', minHeight:148 }}>
        <div style={{ position:'absolute', top:-60, right:-60, width:280, height:280, borderRadius:'50%', background:'rgba(139,92,246,.08)', pointerEvents:'none' }}></div>
        <div style={{ position:'absolute', top:10, right:180, width:120, height:120, borderRadius:'50%', background:'rgba(99,102,241,.1)', pointerEvents:'none' }}></div>
        <div style={{ position:'relative', padding:'28px 28px 24px', display:'flex', flexWrap:'wrap', alignItems:'center', justifyContent:'space-between', gap:16 }}>
          <div>
            <div style={{ display:'inline-flex', alignItems:'center', gap:7, padding:'5px 12px', borderRadius:99, background:'rgba(255,255,255,.07)', border:'1px solid rgba(255,255,255,.1)', marginBottom:10 }}>
              <span style={{ width:6, height:6, borderRadius:'50%', background:'#34d399', animation:'sb-pulse 2.5s ease infinite' }}></span>
              <span style={{ fontSize:11, fontWeight:600, color:'rgba(199,210,254,.75)' }}>{new Date().toLocaleDateString('en-US',{weekday:'long',month:'long',day:'numeric'})}</span>
            </div>
            <h1 style={{ fontSize:'clamp(1.4rem,3vw,1.85rem)', fontWeight:900, color:'#fff', lineHeight:1.15, letterSpacing:'-.4px' }}>
              {greeting}, {user?.name?.split(' ')[0] || 'there'}!
            </h1>
            <p style={{ marginTop:6, fontSize:13, color:'rgba(196,181,253,.5)' }}>Here's what's happening with your account today.</p>
          </div>
          <div style={{ display:'flex', gap:8 }}>
            <Link to="/dashboard/add-prompt" style={{ display:'inline-flex', alignItems:'center', gap:6, padding:'9px 16px', borderRadius:10, fontSize:13, fontWeight:700, color:'#fff', textDecoration:'none', background:'linear-gradient(135deg,#6366f1,#8b5cf6)', boxShadow:'0 4px 16px rgba(99,102,241,.4)', transition:'all .15s' }}
              onMouseEnter={e => { e.currentTarget.style.transform='translateY(-1px)'; e.currentTarget.style.boxShadow='0 8px 24px rgba(99,102,241,.5)' }}
              onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 4px 16px rgba(99,102,241,.4)' }}
            >
              <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
              New Prompt
            </Link>
            <Link to="/prompts" style={{ display:'inline-flex', alignItems:'center', gap:6, padding:'9px 16px', borderRadius:10, fontSize:13, fontWeight:700, color:'#e0e7ff', textDecoration:'none', background:'rgba(255,255,255,.1)', border:'1px solid rgba(255,255,255,.14)', transition:'all .15s' }}
              onMouseEnter={e => e.currentTarget.style.background='rgba(255,255,255,.17)'}
              onMouseLeave={e => e.currentTarget.style.background='rgba(255,255,255,.1)'}
            >
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
              Browse
            </Link>
          </div>
        </div>
      </div>

      {/* KPI Grid */}
      <div className="dash-fade-1" style={{ display:'grid', gridTemplateColumns:'repeat(auto-fit,minmax(200px,1fr))', gap:16, marginBottom:20 }}>
        <KpiCard label="My Prompts"    value={stats?.total_prompts ?? '—'} sub="Total submissions"  grad="linear-gradient(135deg,#9333ea,#7e22ce)" icon="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" loading={loading} />
        <KpiCard label="Saved Prompts" value={stats?.saved_count ?? '—'} sub="Bookmarked"          grad="linear-gradient(135deg,#0284c7,#0891b2)" icon="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" loading={loading} />
        <KpiCard label="My Reviews"    value={stats?.total_reviews ?? '—'} sub="Reviews written"   grad="linear-gradient(135deg,#d97706,#b45309)" icon="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" loading={loading} />
        <KpiCard label="Total Views"   value={stats?.total_views ?? '—'} sub="Across your prompts" grad="linear-gradient(135deg,#059669,#047857)" icon="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z" loading={loading} />
      </div>

      {/* Activity + Quick Actions */}
      <div className="dash-fade-2" style={{ display:'grid', gridTemplateColumns:'1fr', gap:16, marginBottom:20 }}>
        <div style={{ display:'grid', gridTemplateColumns:'minmax(0,1.5fr) minmax(0,1fr)', gap:16 }}>

          {/* Recent Prompts */}
          <div style={{ background:'#fff', borderRadius:16, overflow:'hidden', border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)' }}>
            <div style={{ display:'flex', alignItems:'center', justifyContent:'space-between', padding:'16px 20px', borderBottom:'1px solid #f1f5f9' }}>
              <div style={{ display:'flex', alignItems:'center', gap:9 }}>
                <div style={{ width:28, height:28, borderRadius:8, background:'linear-gradient(135deg,#9333ea,#7e22ce)', display:'flex', alignItems:'center', justifyContent:'center' }}>
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <span style={{ fontSize:13.5, fontWeight:700, color:'#1e293b' }}>Recent Prompts</span>
              </div>
              <Link to="/dashboard/my-prompts" style={{ fontSize:11.5, fontWeight:600, color:'#6366f1', textDecoration:'none' }}>View all →</Link>
            </div>
            {loading ? (
              Array.from({length:3}).map((_,i) => (
                <div key={i} style={{ display:'flex', gap:12, padding:'14px 20px', borderBottom:'1px solid #f8fafc' }}>
                  <div style={{ width:36, height:36, borderRadius:10, background:'#f1f5f9', flexShrink:0 }}></div>
                  <div style={{ flex:1 }}>
                    <div style={{ height:13, borderRadius:4, background:'#f1f5f9', marginBottom:7, width:'70%' }}></div>
                    <div style={{ height:10, borderRadius:4, background:'#f8fafc', width:'40%' }}></div>
                  </div>
                </div>
              ))
            ) : recentPrompts.length === 0 ? (
              <div style={{ padding:'40px 20px', textAlign:'center' }}>
                <div style={{ width:52, height:52, borderRadius:14, background:'linear-gradient(135deg,#f5f3ff,#ede9fe)', display:'flex', alignItems:'center', justifyContent:'center', margin:'0 auto 12px' }}>
                  <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" strokeWidth="1.5"><path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <p style={{ fontSize:13.5, fontWeight:700, color:'#475569' }}>No prompts yet</p>
                <Link to="/dashboard/add-prompt" style={{ display:'inline-block', marginTop:10, fontSize:12, fontWeight:600, color:'#6366f1', textDecoration:'none' }}>Create your first →</Link>
              </div>
            ) : recentPrompts.map(p => {
              const ss = STATUS_STYLE[p.status] || { bg:'#f1f5f9', c:'#64748b' }
              return (
                <div key={p.id} style={{ display:'flex', alignItems:'center', gap:12, padding:'13px 20px', borderBottom:'1px solid #f8fafc', transition:'background .1s' }}
                  onMouseEnter={e => e.currentTarget.style.background='#f8faff'}
                  onMouseLeave={e => e.currentTarget.style.background='transparent'}
                >
                  <div style={{ width:36, height:36, borderRadius:10, background:'linear-gradient(135deg,#9333ea,#7e22ce)', display:'flex', alignItems:'center', justifyContent:'center', color:'#fff', fontSize:14, fontWeight:700, flexShrink:0 }}>
                    {p.title?.[0]?.toUpperCase() || 'P'}
                  </div>
                  <div style={{ flex:1, minWidth:0 }}>
                    <Link to={`/prompts/${p.id}`} style={{ fontSize:13, fontWeight:600, color:'#1e293b', textDecoration:'none', display:'block', overflow:'hidden', textOverflow:'ellipsis', whiteSpace:'nowrap' }}>{p.title}</Link>
                    <p style={{ fontSize:11, color:'#94a3b8', marginTop:1 }}>{p.category || 'Uncategorized'}</p>
                  </div>
                  <span style={{ fontSize:10.5, fontWeight:700, padding:'3px 9px', borderRadius:99, background:ss.bg, color:ss.c, flexShrink:0 }}>{p.status}</span>
                </div>
              )
            })}
          </div>

          {/* Quick Actions */}
          <div>
            <p style={{ fontSize:11, fontWeight:700, color:'#94a3b8', textTransform:'uppercase', letterSpacing:'.12em', marginBottom:12 }}>Quick Actions</p>
            <div style={{ display:'flex', flexDirection:'column', gap:10 }}>
              <QuickAction to="/dashboard/add-prompt"    grad="linear-gradient(135deg,#4f46e5,#7c3aed)" label="Add Prompt"     sub="Submit new content"    icon="M12 4.5v15m7.5-7.5h-15" />
              <QuickAction to="/dashboard/my-prompts"    grad="linear-gradient(135deg,#9333ea,#7e22ce)" label="My Prompts"     sub="Manage submissions"    icon="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
              <QuickAction to="/dashboard/saved-prompts" grad="linear-gradient(135deg,#0284c7,#0891b2)" label="Saved Prompts"  sub="View bookmarks"        icon="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
              <QuickAction to="/dashboard/my-reviews"    grad="linear-gradient(135deg,#d97706,#b45309)" label="My Reviews"     sub="Ratings you've written" icon="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </div>
          </div>
        </div>
      </div>

    </div>
  )
}
