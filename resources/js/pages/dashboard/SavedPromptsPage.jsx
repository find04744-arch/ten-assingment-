import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import { toast } from 'react-toastify'
import { bookmarkAPI } from '../../api'

const CARD_GRADIENTS = [
  'linear-gradient(135deg,#6366f1,#8b5cf6)',
  'linear-gradient(135deg,#0284c7,#06b6d4)',
  'linear-gradient(135deg,#059669,#0891b2)',
  'linear-gradient(135deg,#d97706,#f59e0b)',
  'linear-gradient(135deg,#e11d48,#f43f5e)',
]

function SkeletonCard() {
  return (
    <div style={{ background:'#fff', borderRadius:16, border:'1px solid #e5e9f0', overflow:'hidden' }}>
      <div style={{ height:5, background:'#f1f5f9' }}></div>
      <div style={{ padding:18 }}>
        <div style={{ height:14, borderRadius:4, background:'#f1f5f9', width:'80%', marginBottom:8 }}></div>
        <div style={{ height:11, borderRadius:4, background:'#f8fafc', width:'100%', marginBottom:5 }}></div>
        <div style={{ height:11, borderRadius:4, background:'#f8fafc', width:'65%', marginBottom:16 }}></div>
        <div style={{ height:34, borderRadius:9, background:'#f1f5f9' }}></div>
      </div>
    </div>
  )
}

export default function SavedPromptsPage() {
  const [saved, setSaved] = useState([])
  const [loading, setLoading] = useState(true)
  const [removing, setRemoving] = useState(null)

  useEffect(() => {
    bookmarkAPI.getAll()
      .then(res => {
        const data = res.data
        setSaved(Array.isArray(data) ? data : (data?.data || []))
      })
      .catch(() => toast.error('Failed to load saved prompts'))
      .finally(() => setLoading(false))
  }, [])

  const handleRemove = async (promptId, title) => {
    setRemoving(promptId)
    try {
      await bookmarkAPI.toggle(promptId)
      setSaved(prev => prev.filter(p => (p.prompt_id || p.id) !== promptId))
      toast.success(`Removed "${title}" from saved`)
    } catch {
      toast.error('Failed to remove bookmark')
    } finally {
      setRemoving(null)
    }
  }

  return (
    <div style={{ maxWidth:1100, margin:'0 auto' }}>
      <style>{`@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.sp-fade{animation:fadeUp .4s cubic-bezier(.16,1,.3,1) both;}`}</style>

      {/* Header */}
      <div className="sp-fade" style={{ position:'relative', overflow:'hidden', borderRadius:20, marginBottom:22, background:'linear-gradient(135deg,#1e3a5f 0%,#1d4ed8 55%,#0891b2 100%)', padding:'24px 28px' }}>
        <div style={{ position:'absolute', top:-40, right:-40, width:200, height:200, borderRadius:'50%', background:'rgba(255,255,255,.05)', pointerEvents:'none' }}></div>
        <div style={{ position:'relative' }}>
          <p style={{ fontSize:10, fontWeight:700, color:'rgba(186,230,253,.65)', textTransform:'uppercase', letterSpacing:'.2em', marginBottom:5 }}>Saved Collection</p>
          <p style={{ fontSize:28, fontWeight:900, color:'#fff', lineHeight:1.15, letterSpacing:'-.5px' }}>
            {loading ? '...' : saved.length} <span style={{ fontSize:16, fontWeight:500, color:'rgba(186,230,253,.55)' }}>bookmarked prompts</span>
          </p>
        </div>
      </div>

      {loading ? (
        <div style={{ display:'grid', gridTemplateColumns:'repeat(auto-fill,minmax(280px,1fr))', gap:16 }}>
          {Array.from({length:6}).map((_,i) => <SkeletonCard key={i} />)}
        </div>
      ) : saved.length === 0 ? (
        <div style={{ textAlign:'center', padding:'80px 24px', background:'#fff', borderRadius:20, border:'1px solid #e5e9f0' }}>
          <div style={{ width:72, height:72, borderRadius:20, background:'linear-gradient(135deg,#eff6ff,#dbeafe)', display:'flex', alignItems:'center', justifyContent:'center', margin:'0 auto 16px' }}>
            <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="#2563eb" strokeWidth="1.5"><path strokeLinecap="round" strokeLinejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/></svg>
          </div>
          <p style={{ fontSize:16, fontWeight:700, color:'#475569' }}>No saved prompts yet</p>
          <p style={{ fontSize:13, color:'#94a3b8', marginTop:5 }}>Browse the marketplace and bookmark prompts you love.</p>
          <Link to="/prompts" style={{ display:'inline-flex', alignItems:'center', gap:6, marginTop:18, padding:'10px 20px', borderRadius:10, fontSize:13, fontWeight:700, color:'#fff', textDecoration:'none', background:'linear-gradient(135deg,#1d4ed8,#0891b2)', boxShadow:'0 4px 14px rgba(29,78,216,.35)' }}>
            Browse Prompts →
          </Link>
        </div>
      ) : (
        <div style={{ display:'grid', gridTemplateColumns:'repeat(auto-fill,minmax(280px,1fr))', gap:16 }}>
          {saved.map((item, idx) => {
            const prompt = item.prompt || item
            const promptId = prompt.id
            const grad = CARD_GRADIENTS[idx % CARD_GRADIENTS.length]
            return (
              <div key={promptId} style={{ background:'#fff', borderRadius:16, border:'1px solid #e5e9f0', boxShadow:'0 2px 10px rgba(0,0,0,.04)', overflow:'hidden', transition:'transform .2s, box-shadow .2s' }}
                onMouseEnter={e => { e.currentTarget.style.transform='translateY(-3px)'; e.currentTarget.style.boxShadow='0 14px 36px rgba(0,0,0,.09)' }}
                onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 2px 10px rgba(0,0,0,.04)' }}
              >
                <div style={{ height:4, background:grad }}></div>
                <div style={{ padding:18 }}>
                  <div style={{ display:'flex', alignItems:'flex-start', justifyContent:'space-between', gap:8, marginBottom:8 }}>
                    <Link to={`/prompts/${promptId}`} style={{ fontSize:14.5, fontWeight:700, color:'#1e293b', textDecoration:'none', lineHeight:1.3, flex:1 }}>{prompt.title}</Link>
                    <button
                      onClick={() => handleRemove(promptId, prompt.title)}
                      disabled={removing === promptId}
                      title="Remove bookmark"
                      style={{ width:28, height:28, borderRadius:8, border:'none', background:'#fff5f5', cursor:'pointer', display:'flex', alignItems:'center', justifyContent:'center', color:'#f87171', flexShrink:0, transition:'all .15s' }}
                      onMouseEnter={e => { e.currentTarget.style.background='linear-gradient(135deg,#ef4444,#dc2626)'; e.currentTarget.style.color='#fff' }}
                      onMouseLeave={e => { e.currentTarget.style.background='#fff5f5'; e.currentTarget.style.color='#f87171' }}
                    >
                      {removing === promptId ? (
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                      ) : (
                        <svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/></svg>
                      )}
                    </button>
                  </div>
                  {prompt.description && (
                    <p style={{ fontSize:12, color:'#64748b', lineHeight:1.5, marginBottom:12, display:'-webkit-box', WebkitLineClamp:2, WebkitBoxOrient:'vertical', overflow:'hidden' }}>
                      {prompt.description}
                    </p>
                  )}
                  <div style={{ display:'flex', alignItems:'center', gap:8, marginBottom:14 }}>
                    {prompt.category && (
                      <span style={{ fontSize:10, fontWeight:700, padding:'2px 8px', borderRadius:99, background:'#f1f5f9', color:'#64748b', textTransform:'uppercase', letterSpacing:'.08em' }}>{prompt.category}</span>
                    )}
                    {prompt.user?.name && (
                      <span style={{ fontSize:11, color:'#94a3b8' }}>by {prompt.user.name}</span>
                    )}
                    {prompt.price > 0 ? (
                      <span style={{ fontSize:11, fontWeight:700, color:'#059669', marginLeft:'auto' }}>${Number(prompt.price).toFixed(2)}</span>
                    ) : (
                      <span style={{ fontSize:11, fontWeight:700, color:'#94a3b8', marginLeft:'auto' }}>Free</span>
                    )}
                  </div>
                  <Link to={`/prompts/${promptId}`}
                    style={{ display:'flex', alignItems:'center', justifyContent:'center', gap:6, padding:'8px 0', borderRadius:9, fontSize:12.5, fontWeight:600, color:'#fff', textDecoration:'none', background:grad, boxShadow:'0 3px 10px rgba(0,0,0,.2)', transition:'all .15s' }}
                    onMouseEnter={e => { e.currentTarget.style.transform='translateY(-1px)'; e.currentTarget.style.boxShadow='0 6px 18px rgba(0,0,0,.25)' }}
                    onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 3px 10px rgba(0,0,0,.2)' }}
                  >
                    View Prompt
                    <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                  </Link>
                </div>
              </div>
            )
          })}
        </div>
      )}
    </div>
  )
}
