import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import { toast } from 'react-toastify'
import { promptAPI } from '../../api'

const STATUS_MAP = {
  approved: { bg:'linear-gradient(135deg,#10b981,#059669)', c:'#fff', dot:'#10b981' },
  pending:  { bg:'linear-gradient(135deg,#f59e0b,#d97706)', c:'#fff', dot:'#f59e0b' },
  rejected: { bg:'linear-gradient(135deg,#f43f5e,#dc2626)', c:'#fff', dot:'#f43f5e' },
}

const CARD_GRADIENTS = [
  'linear-gradient(135deg,#4f46e5,#7c3aed)',
  'linear-gradient(135deg,#9333ea,#7e22ce)',
  'linear-gradient(135deg,#0284c7,#0891b2)',
  'linear-gradient(135deg,#059669,#047857)',
  'linear-gradient(135deg,#d97706,#b45309)',
]

function SkeletonCard() {
  return (
    <div style={{ background:'#fff', borderRadius:16, border:'1px solid #e5e9f0', overflow:'hidden', boxShadow:'0 2px 10px rgba(0,0,0,.04)' }}>
      <div style={{ height:5, background:'linear-gradient(90deg,#f1f5f9,#e2e8f0,#f1f5f9)', backgroundSize:'200% 100%', animation:'shimmer 1.5s infinite' }}></div>
      <div style={{ padding:20 }}>
        <div style={{ height:14, borderRadius:4, background:'#f1f5f9', width:'75%', marginBottom:10 }}></div>
        <div style={{ height:11, borderRadius:4, background:'#f8fafc', width:'90%', marginBottom:6 }}></div>
        <div style={{ height:11, borderRadius:4, background:'#f8fafc', width:'60%' }}></div>
        <div style={{ display:'flex', gap:8, marginTop:16 }}>
          <div style={{ height:28, width:70, borderRadius:8, background:'#f1f5f9' }}></div>
          <div style={{ height:28, width:70, borderRadius:8, background:'#f1f5f9' }}></div>
        </div>
      </div>
    </div>
  )
}

export default function MyPromptsPage() {
  const [prompts, setPrompts] = useState([])
  const [loading, setLoading] = useState(true)
  const [deleting, setDeleting] = useState(null)

  useEffect(() => {
    promptAPI.getUserPrompts()
      .then(res => {
        const data = res.data
        setPrompts(Array.isArray(data) ? data : (data?.data || []))
      })
      .catch(() => toast.error('Failed to load prompts'))
      .finally(() => setLoading(false))
  }, [])

  const handleDelete = async (id, title) => {
    if (!confirm(`Delete "${title}"? This cannot be undone.`)) return
    setDeleting(id)
    try {
      await promptAPI.delete(id)
      setPrompts(prev => prev.filter(p => p.id !== id))
      toast.success('Prompt deleted')
    } catch {
      toast.error('Failed to delete prompt')
    } finally {
      setDeleting(null)
    }
  }

  const counts = { total: prompts.length, approved: prompts.filter(p => p.status === 'approved').length, pending: prompts.filter(p => p.status === 'pending').length }

  return (
    <div style={{ maxWidth:1100, margin:'0 auto' }}>
      <style>{`
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
        @keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .mp-fade { animation: fadeUp .4s cubic-bezier(.16,1,.3,1) both; }
      `}</style>

      {/* Header */}
      <div className="mp-fade" style={{ position:'relative', overflow:'hidden', borderRadius:20, marginBottom:22, background:'linear-gradient(135deg,#2e1065 0%,#6d28d9 55%,#7c3aed 100%)', padding:'24px 28px' }}>
        <div style={{ position:'absolute', top:-40, right:-40, width:200, height:200, borderRadius:'50%', background:'rgba(255,255,255,.05)', pointerEvents:'none' }}></div>
        <div style={{ position:'relative', display:'flex', flexWrap:'wrap', alignItems:'center', gap:16 }}>
          <div style={{ flex:1 }}>
            <p style={{ fontSize:10, fontWeight:700, color:'rgba(221,214,254,.6)', textTransform:'uppercase', letterSpacing:'.2em', marginBottom:5 }}>Content Library</p>
            <p style={{ fontSize:28, fontWeight:900, color:'#fff', lineHeight:1.15, letterSpacing:'-.5px' }}>
              {loading ? '...' : counts.total} <span style={{ fontSize:16, fontWeight:500, color:'rgba(221,214,254,.55)' }}>total prompts</span>
            </p>
          </div>
          <div style={{ display:'flex', gap:10 }}>
            <div style={{ display:'flex', flexDirection:'column', alignItems:'center', padding:'10px 18px', borderRadius:12, background:'rgba(16,185,129,.18)', border:'1px solid rgba(16,185,129,.3)' }}>
              <span style={{ fontSize:20, fontWeight:900, color:'#6ee7b7' }}>{counts.approved}</span>
              <span style={{ fontSize:10, color:'rgba(110,231,183,.65)', fontWeight:600, marginTop:2 }}>Approved</span>
            </div>
            <div style={{ display:'flex', flexDirection:'column', alignItems:'center', padding:'10px 18px', borderRadius:12, background:'rgba(245,158,11,.18)', border:'1px solid rgba(245,158,11,.3)' }}>
              <span style={{ fontSize:20, fontWeight:900, color:'#fcd34d' }}>{counts.pending}</span>
              <span style={{ fontSize:10, color:'rgba(252,211,77,.65)', fontWeight:600, marginTop:2 }}>Pending</span>
            </div>
          </div>
          <Link to="/dashboard/add-prompt" style={{ display:'inline-flex', alignItems:'center', gap:6, padding:'9px 16px', borderRadius:10, fontSize:12.5, fontWeight:700, color:'#fff', textDecoration:'none', background:'linear-gradient(135deg,#6366f1,#8b5cf6)', boxShadow:'0 4px 14px rgba(99,102,241,.4)' }}>
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            New Prompt
          </Link>
        </div>
      </div>

      {/* Grid */}
      {loading ? (
        <div style={{ display:'grid', gridTemplateColumns:'repeat(auto-fill,minmax(280px,1fr))', gap:16 }}>
          {Array.from({length:6}).map((_,i) => <SkeletonCard key={i} />)}
        </div>
      ) : prompts.length === 0 ? (
        <div style={{ textAlign:'center', padding:'80px 24px', background:'#fff', borderRadius:20, border:'1px solid #e5e9f0' }}>
          <div style={{ width:72, height:72, borderRadius:20, background:'linear-gradient(135deg,#f5f3ff,#ede9fe)', display:'flex', alignItems:'center', justifyContent:'center', margin:'0 auto 16px' }}>
            <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="#7c3aed" strokeWidth="1.5"><path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
          </div>
          <p style={{ fontSize:16, fontWeight:700, color:'#475569' }}>No prompts yet</p>
          <p style={{ fontSize:13, color:'#94a3b8', marginTop:5 }}>Create your first prompt and start sharing with the community.</p>
          <Link to="/dashboard/add-prompt" style={{ display:'inline-flex', alignItems:'center', gap:6, marginTop:18, padding:'10px 20px', borderRadius:10, fontSize:13, fontWeight:700, color:'#fff', textDecoration:'none', background:'linear-gradient(135deg,#6366f1,#8b5cf6)', boxShadow:'0 4px 14px rgba(99,102,241,.35)' }}>
            <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Create First Prompt
          </Link>
        </div>
      ) : (
        <div style={{ display:'grid', gridTemplateColumns:'repeat(auto-fill,minmax(280px,1fr))', gap:16 }}>
          {prompts.map((prompt, idx) => {
            const ss = STATUS_MAP[prompt.status] || { bg:'#f1f5f9', c:'#64748b', dot:'#94a3b8' }
            const grad = CARD_GRADIENTS[idx % CARD_GRADIENTS.length]
            return (
              <div key={prompt.id} style={{ background:'#fff', borderRadius:16, border:'1px solid #e5e9f0', boxShadow:'0 2px 10px rgba(0,0,0,.04)', overflow:'hidden', transition:'transform .2s, box-shadow .2s' }}
                onMouseEnter={e => { e.currentTarget.style.transform='translateY(-3px)'; e.currentTarget.style.boxShadow='0 14px 36px rgba(0,0,0,.09)' }}
                onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 2px 10px rgba(0,0,0,.04)' }}
              >
                {/* Top accent bar */}
                <div style={{ height:4, background:grad }}></div>
                <div style={{ padding:18 }}>
                  <div style={{ display:'flex', alignItems:'flex-start', justifyContent:'space-between', gap:8, marginBottom:10 }}>
                    <Link to={`/prompts/${prompt.id}`} style={{ fontSize:14.5, fontWeight:700, color:'#1e293b', textDecoration:'none', lineHeight:1.3, flex:1 }}>{prompt.title}</Link>
                    <span style={{ display:'inline-flex', alignItems:'center', padding:'3px 9px', borderRadius:99, fontSize:10.5, fontWeight:700, background:ss.bg, color:ss.c, flexShrink:0 }}>
                      {prompt.status}
                    </span>
                  </div>
                  {prompt.description && (
                    <p style={{ fontSize:12, color:'#64748b', lineHeight:1.5, marginBottom:12, display:'-webkit-box', WebkitLineClamp:2, WebkitBoxOrient:'vertical', overflow:'hidden' }}>
                      {prompt.description}
                    </p>
                  )}
                  <div style={{ display:'flex', alignItems:'center', gap:8, marginBottom:14, flexWrap:'wrap' }}>
                    {prompt.category && (
                      <span style={{ fontSize:10, fontWeight:700, padding:'2px 8px', borderRadius:99, background:'#f1f5f9', color:'#64748b', textTransform:'uppercase', letterSpacing:'.08em' }}>{prompt.category}</span>
                    )}
                    {prompt.price > 0 ? (
                      <span style={{ fontSize:11, fontWeight:700, color:'#059669' }}>${Number(prompt.price).toFixed(2)}</span>
                    ) : (
                      <span style={{ fontSize:11, fontWeight:700, color:'#94a3b8' }}>Free</span>
                    )}
                    {prompt.is_featured && (
                      <span style={{ fontSize:10, fontWeight:700, padding:'2px 8px', borderRadius:99, background:'linear-gradient(135deg,#f59e0b,#f97316)', color:'#fff' }}>⭐ Featured</span>
                    )}
                  </div>
                  <div style={{ display:'flex', alignItems:'center', gap:6 }}>
                    <Link to={`/prompts/${prompt.id}`} style={{ flex:1, display:'flex', alignItems:'center', justifyContent:'center', gap:5, padding:'7px 0', borderRadius:9, fontSize:12, fontWeight:600, color:'#6366f1', textDecoration:'none', background:'#eef2ff', border:'1px solid #e0e7ff', transition:'all .15s' }}
                      onMouseEnter={e => { e.currentTarget.style.background='linear-gradient(135deg,#4f46e5,#7c3aed)'; e.currentTarget.style.color='#fff'; e.currentTarget.style.borderColor='transparent' }}
                      onMouseLeave={e => { e.currentTarget.style.background='#eef2ff'; e.currentTarget.style.color='#6366f1'; e.currentTarget.style.borderColor='#e0e7ff' }}
                    >
                      <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                      View
                    </Link>
                    <button
                      onClick={() => handleDelete(prompt.id, prompt.title)}
                      disabled={deleting === prompt.id}
                      style={{ display:'flex', alignItems:'center', justifyContent:'center', gap:5, padding:'7px 14px', borderRadius:9, fontSize:12, fontWeight:600, color:'#dc2626', background:'#fff1f2', border:'1px solid #fecdd3', cursor:'pointer', transition:'all .15s' }}
                      onMouseEnter={e => { e.currentTarget.style.background='linear-gradient(135deg,#ef4444,#dc2626)'; e.currentTarget.style.color='#fff'; e.currentTarget.style.borderColor='transparent' }}
                      onMouseLeave={e => { e.currentTarget.style.background='#fff1f2'; e.currentTarget.style.color='#dc2626'; e.currentTarget.style.borderColor='#fecdd3' }}
                    >
                      {deleting === prompt.id ? '...' : (
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                      )}
                    </button>
                  </div>
                </div>
              </div>
            )
          })}
        </div>
      )}
    </div>
  )
}
