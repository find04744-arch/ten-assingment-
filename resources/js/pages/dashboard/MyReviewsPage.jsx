import React, { useEffect, useState } from 'react'
import { Link } from 'react-router-dom'
import { toast } from 'react-toastify'
import { reviewAPI } from '../../api'

const Stars = ({ rating, size = 14 }) => (
  <div style={{ display:'flex', gap:2 }}>
    {[1,2,3,4,5].map(s => (
      <svg key={s} width={size} height={size} viewBox="0 0 20 20" fill={s <= rating ? '#f59e0b' : '#e2e8f0'}>
        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
      </svg>
    ))}
  </div>
)

const RATING_GRAD = {
  5: 'linear-gradient(135deg,#10b981,#059669)',
  4: 'linear-gradient(135deg,#6366f1,#8b5cf6)',
  3: 'linear-gradient(135deg,#f59e0b,#d97706)',
  2: 'linear-gradient(135deg,#f97316,#ea580c)',
  1: 'linear-gradient(135deg,#f43f5e,#dc2626)',
}

function SkeletonCard() {
  return (
    <div style={{ background:'#fff', borderRadius:16, padding:20, border:'1px solid #e5e9f0', boxShadow:'0 2px 10px rgba(0,0,0,.04)' }}>
      <div style={{ display:'flex', alignItems:'center', gap:12, marginBottom:14 }}>
        <div style={{ width:44, height:44, borderRadius:12, background:'#f1f5f9', flexShrink:0 }}></div>
        <div style={{ flex:1 }}>
          <div style={{ height:13, borderRadius:4, background:'#f1f5f9', width:'70%', marginBottom:7 }}></div>
          <div style={{ height:10, borderRadius:4, background:'#f8fafc', width:'40%' }}></div>
        </div>
      </div>
      <div style={{ height:11, borderRadius:4, background:'#f8fafc', marginBottom:5 }}></div>
      <div style={{ height:11, borderRadius:4, background:'#f8fafc', width:'80%' }}></div>
    </div>
  )
}

export default function MyReviewsPage() {
  const [reviews, setReviews] = useState([])
  const [loading, setLoading] = useState(true)
  const [deleting, setDeleting] = useState(null)

  useEffect(() => {
    reviewAPI.getUserReviews()
      .then(res => {
        const data = res.data
        setReviews(Array.isArray(data) ? data : (data?.data || []))
      })
      .catch(() => toast.error('Failed to load reviews'))
      .finally(() => setLoading(false))
  }, [])

  const handleDelete = async (id) => {
    if (!confirm('Delete this review? This cannot be undone.')) return
    setDeleting(id)
    try {
      await reviewAPI.delete(id)
      setReviews(prev => prev.filter(r => r.id !== id))
      toast.success('Review deleted')
    } catch {
      toast.error('Failed to delete review')
    } finally {
      setDeleting(null)
    }
  }

  const avgRating = reviews.length > 0
    ? (reviews.reduce((s, r) => s + (r.rating || 0), 0) / reviews.length).toFixed(1)
    : '—'

  return (
    <div style={{ maxWidth:900, margin:'0 auto' }}>
      <style>{`@keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.rv-fade{animation:fadeUp .4s cubic-bezier(.16,1,.3,1) both;}`}</style>

      {/* Header */}
      <div className="rv-fade" style={{ position:'relative', overflow:'hidden', borderRadius:20, marginBottom:22, background:'linear-gradient(135deg,#451a03 0%,#b45309 55%,#d97706 100%)', padding:'24px 28px' }}>
        <div style={{ position:'absolute', top:-40, right:-40, width:200, height:200, borderRadius:'50%', background:'rgba(255,255,255,.05)', pointerEvents:'none' }}></div>
        <div style={{ position:'relative', display:'flex', flexWrap:'wrap', alignItems:'center', gap:16 }}>
          <div style={{ flex:1 }}>
            <p style={{ fontSize:10, fontWeight:700, color:'rgba(254,243,199,.6)', textTransform:'uppercase', letterSpacing:'.2em', marginBottom:5 }}>My Reviews</p>
            <p style={{ fontSize:28, fontWeight:900, color:'#fff', lineHeight:1.15, letterSpacing:'-.5px' }}>
              {loading ? '...' : reviews.length} <span style={{ fontSize:16, fontWeight:500, color:'rgba(254,243,199,.55)' }}>reviews written</span>
            </p>
          </div>
          {!loading && reviews.length > 0 && (
            <div style={{ display:'flex', flexDirection:'column', alignItems:'center', padding:'12px 20px', borderRadius:14, background:'rgba(255,255,255,.12)', border:'1px solid rgba(255,255,255,.18)' }}>
              <span style={{ fontSize:26, fontWeight:900, color:'#fef3c7' }}>{avgRating}</span>
              <Stars rating={Math.round(Number(avgRating))} size={13} />
              <span style={{ fontSize:10, color:'rgba(254,243,199,.6)', marginTop:4 }}>avg rating</span>
            </div>
          )}
        </div>
      </div>

      {loading ? (
        <div style={{ display:'flex', flexDirection:'column', gap:14 }}>
          {Array.from({length:4}).map((_,i) => <SkeletonCard key={i} />)}
        </div>
      ) : reviews.length === 0 ? (
        <div style={{ textAlign:'center', padding:'80px 24px', background:'#fff', borderRadius:20, border:'1px solid #e5e9f0' }}>
          <div style={{ width:72, height:72, borderRadius:20, background:'linear-gradient(135deg,#fffbeb,#fef3c7)', display:'flex', alignItems:'center', justifyContent:'center', margin:'0 auto 16px' }}>
            <svg width="34" height="34" fill="none" viewBox="0 0 24 24" stroke="#d97706" strokeWidth="1.5"><path strokeLinecap="round" strokeLinejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
          </div>
          <p style={{ fontSize:16, fontWeight:700, color:'#475569' }}>No reviews yet</p>
          <p style={{ fontSize:13, color:'#94a3b8', marginTop:5 }}>Visit prompts you've used and share your experience!</p>
          <Link to="/prompts" style={{ display:'inline-flex', alignItems:'center', gap:6, marginTop:18, padding:'10px 20px', borderRadius:10, fontSize:13, fontWeight:700, color:'#fff', textDecoration:'none', background:'linear-gradient(135deg,#d97706,#b45309)', boxShadow:'0 4px 14px rgba(217,119,6,.35)' }}>
            Browse Prompts →
          </Link>
        </div>
      ) : (
        <div style={{ display:'flex', flexDirection:'column', gap:14 }}>
          {reviews.map(review => {
            const prompt = review.prompt
            const ratingGrad = RATING_GRAD[review.rating] || RATING_GRAD[3]
            return (
              <div key={review.id} style={{ background:'#fff', borderRadius:16, border:'1px solid #e5e9f0', boxShadow:'0 2px 10px rgba(0,0,0,.04)', overflow:'hidden', transition:'box-shadow .2s' }}
                onMouseEnter={e => e.currentTarget.style.boxShadow='0 8px 28px rgba(0,0,0,.08)'}
                onMouseLeave={e => e.currentTarget.style.boxShadow='0 2px 10px rgba(0,0,0,.04)'}
              >
                {/* Top accent */}
                <div style={{ height:3, background:ratingGrad }}></div>
                <div style={{ padding:20 }}>
                  <div style={{ display:'flex', alignItems:'flex-start', gap:14 }}>
                    {/* Rating badge */}
                    <div style={{ width:48, height:48, borderRadius:14, background:ratingGrad, display:'flex', alignItems:'center', justifyContent:'center', flexShrink:0, boxShadow:'0 4px 14px rgba(0,0,0,.2)' }}>
                      <span style={{ fontSize:20, fontWeight:900, color:'#fff', lineHeight:1 }}>{review.rating}</span>
                    </div>

                    <div style={{ flex:1, minWidth:0 }}>
                      <div style={{ display:'flex', alignItems:'flex-start', justifyContent:'space-between', gap:8 }}>
                        <div>
                          {prompt ? (
                            <Link to={`/prompts/${prompt.id}`} style={{ fontSize:14.5, fontWeight:700, color:'#1e293b', textDecoration:'none', display:'block' }}>
                              {prompt.title}
                            </Link>
                          ) : (
                            <p style={{ fontSize:14.5, fontWeight:700, color:'#94a3b8' }}>Deleted prompt</p>
                          )}
                          <div style={{ display:'flex', alignItems:'center', gap:8, marginTop:5 }}>
                            <Stars rating={review.rating} />
                            {review.created_at && (
                              <span style={{ fontSize:11, color:'#94a3b8' }}>
                                {new Date(review.created_at).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'})}
                              </span>
                            )}
                          </div>
                        </div>
                        <button
                          onClick={() => handleDelete(review.id)}
                          disabled={deleting === review.id}
                          style={{ display:'flex', alignItems:'center', gap:4, padding:'5px 10px', borderRadius:8, fontSize:11.5, fontWeight:600, color:'#dc2626', background:'#fff1f2', border:'1px solid #fecdd3', cursor:'pointer', flexShrink:0, transition:'all .15s' }}
                          onMouseEnter={e => { e.currentTarget.style.background='linear-gradient(135deg,#ef4444,#dc2626)'; e.currentTarget.style.color='#fff'; e.currentTarget.style.borderColor='transparent' }}
                          onMouseLeave={e => { e.currentTarget.style.background='#fff1f2'; e.currentTarget.style.color='#dc2626'; e.currentTarget.style.borderColor='#fecdd3' }}
                        >
                          {deleting === review.id ? '...' : (
                            <>
                              <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                              Delete
                            </>
                          )}
                        </button>
                      </div>

                      {review.comment && (
                        <div style={{ marginTop:10, padding:'10px 14px', borderRadius:10, background:'#f8fafc', border:'1px solid #f1f5f9' }}>
                          <p style={{ fontSize:13, color:'#475569', lineHeight:1.6 }}>"{review.comment}"</p>
                        </div>
                      )}
                    </div>
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
