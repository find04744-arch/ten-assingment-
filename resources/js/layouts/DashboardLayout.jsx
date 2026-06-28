import React, { useEffect, useState } from 'react'
import { Outlet, useNavigate, useLocation } from 'react-router-dom'
import { useAuthStore } from '../store/authStore'
import Sidebar from '../components/dashboard/Sidebar'
import LoadingSpinner from '../components/LoadingSpinner'

const PAGE_TITLES = {
  '/dashboard':               { title: 'Dashboard',      sub: 'Welcome back' },
  '/dashboard/my-prompts':    { title: 'My Prompts',     sub: 'Manage your submissions' },
  '/dashboard/saved-prompts': { title: 'Saved Prompts',  sub: 'Your bookmarked prompts' },
  '/dashboard/my-reviews':    { title: 'My Reviews',     sub: 'Reviews you\'ve written' },
  '/dashboard/profile':       { title: 'Profile',        sub: 'Account settings' },
  '/dashboard/add-prompt':    { title: 'Add Prompt',     sub: 'Submit a new prompt' },
  '/creator-dashboard':       { title: 'Creator Hub',    sub: 'Creator analytics' },
  '/admin-dashboard':         { title: 'Admin Panel',    sub: 'Platform management' },
}

export default function DashboardLayout() {
  const { isAuthenticated, isLoading, user } = useAuthStore()
  const navigate = useNavigate()
  const location = useLocation()
  const [sidebarOpen, setSidebarOpen] = useState(false)

  useEffect(() => {
    if (!isAuthenticated && !isLoading) navigate('/login')
  }, [isAuthenticated, isLoading])

  if (isLoading) return <LoadingSpinner />
  if (!isAuthenticated) return null

  const page = PAGE_TITLES[location.pathname] || { title: 'Dashboard', sub: '' }
  const hour = new Date().getHours()
  const greeting = hour < 12 ? 'Good morning' : hour < 17 ? 'Good afternoon' : 'Good evening'

  return (
    <div style={{ display:'flex', height:'100vh', overflow:'hidden', background:'#eef1f7' }}>

      <Sidebar mobileOpen={sidebarOpen} onClose={() => setSidebarOpen(false)} />

      {/* Main area */}
      <div style={{ flex:1, display:'flex', flexDirection:'column', overflow:'hidden', minWidth:0 }}>

        {/* Top bar */}
        <header style={{
          flexShrink:0, height:58, display:'flex', alignItems:'center', gap:10,
          padding:'0 22px', background:'#fff',
          borderBottom:'1px solid #e5e9f0',
          boxShadow:'0 1px 10px rgba(0,0,0,.045)',
        }}>
          {/* Mobile hamburger */}
          <button
            onClick={() => setSidebarOpen(true)}
            className="lg:hidden"
            style={{ width:36, height:36, borderRadius:9, border:'none', background:'#f1f5f9', color:'#64748b', display:'flex', alignItems:'center', justifyContent:'center', cursor:'pointer', flexShrink:0 }}
          >
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
              <path strokeLinecap="round" strokeLinejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
          </button>

          {/* Breadcrumb */}
          <div style={{ display:'flex', alignItems:'center', gap:8, minWidth:0 }}>
            <div style={{ width:3, height:20, borderRadius:99, background:'linear-gradient(180deg,#6366f1,#a855f7)', flexShrink:0 }}></div>
            <span style={{ fontSize:14.5, fontWeight:700, color:'#1e293b' }}>{page.title}</span>
            {page.sub && <>
              <span style={{ color:'#cbd5e1', fontSize:12 }}>›</span>
              <span style={{ fontSize:12, color:'#94a3b8' }} className="hidden sm:inline">{page.sub}</span>
            </>}
          </div>

          <div style={{ flex:1 }}></div>

          {/* Greeting + date */}
          <div style={{ display:'flex', alignItems:'center', gap:10, flexShrink:0 }}>
            <div className="hidden md:flex" style={{ alignItems:'center', gap:5, padding:'5px 11px', borderRadius:8, background:'#f8fafc', border:'1px solid #e9ecef', fontSize:11.5, fontWeight:500, color:'#94a3b8' }}>
              <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                <path strokeLinecap="round" strokeLinejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
              </svg>
              {new Date().toLocaleDateString('en-US', { weekday:'short', month:'short', day:'numeric' })}
            </div>

            {/* User avatar pill */}
            <div style={{ display:'flex', alignItems:'center', gap:8, padding:'5px 12px 5px 6px', borderRadius:99, background:'#f8fafc', border:'1px solid #e9ecef' }}>
              {user?.photo_url ? (
                <img src={user.photo_url} alt="" style={{ width:26, height:26, borderRadius:'50%', objectFit:'cover' }} />
              ) : (
                <div style={{ width:26, height:26, borderRadius:'50%', background:'linear-gradient(135deg,#6366f1,#a855f7)', display:'flex', alignItems:'center', justifyContent:'center', fontSize:11, fontWeight:700, color:'#fff' }}>
                  {user?.name?.[0]?.toUpperCase() || 'U'}
                </div>
              )}
              <span style={{ fontSize:12, fontWeight:600, color:'#475569' }} className="hidden sm:inline">
                {greeting}, {user?.name?.split(' ')[0] || 'there'}!
              </span>
            </div>
          </div>
        </header>

        {/* Page content */}
        <main style={{ flex:1, overflowY:'auto', padding:22 }}>
          <Outlet />
        </main>
      </div>
    </div>
  )
}
