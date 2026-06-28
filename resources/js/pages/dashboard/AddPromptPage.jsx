import React, { useState } from 'react'
import { useNavigate } from 'react-router-dom'
import { toast } from 'react-toastify'
import { promptAPI } from '../../api'

const CATEGORIES = ['Writing', 'Coding', 'Marketing', 'Business', 'Creative', 'Education', 'Research', 'Productivity', 'Other']
const AI_TOOLS  = ['ChatGPT', 'Claude', 'Gemini', 'Midjourney', 'DALL-E', 'Stable Diffusion', 'Copilot', 'Other']

const inputStyle = (err) => ({
  width:'100%', padding:'10px 13px', borderRadius:10,
  border:`1.5px solid ${err ? '#ef4444' : '#e2e8f0'}`,
  fontSize:13.5, color:'#1e293b', outline:'none',
  boxSizing:'border-box', transition:'border-color .15s',
  background:'#fff',
})

const Field = ({ label, required, hint, children, error }) => (
  <div>
    <label style={{ display:'block', fontSize:12, fontWeight:700, color:'#475569', marginBottom:5, letterSpacing:'.01em' }}>
      {label}{required && <span style={{ color:'#ef4444', marginLeft:3 }}>*</span>}
    </label>
    {children}
    {hint && <p style={{ fontSize:11, color:'#94a3b8', marginTop:4 }}>{hint}</p>}
    {error && <p style={{ fontSize:11, color:'#ef4444', marginTop:4, fontWeight:600 }}>{error}</p>}
  </div>
)

export default function AddPromptPage() {
  const navigate = useNavigate()
  const [submitting, setSubmitting] = useState(false)
  const [errors, setErrors] = useState({})
  const [form, setForm] = useState({
    title: '', description: '', content: '', category: '',
    ai_tool: '', price: '', tags: '', is_public: true,
  })
  const [tagInput, setTagInput] = useState('')
  const [tagList, setTagList] = useState([])
  const [preview, setPreview] = useState(false)

  const set = (name, value) => {
    setForm(prev => ({ ...prev, [name]: value }))
    if (errors[name]) setErrors(prev => ({ ...prev, [name]: null }))
  }

  const handleChange = e => set(e.target.name, e.target.type === 'checkbox' ? e.target.checked : e.target.value)

  const addTag = () => {
    const t = tagInput.trim().replace(/,+$/, '')
    if (t && !tagList.includes(t) && tagList.length < 10) {
      setTagList(prev => [...prev, t])
      setTagInput('')
    }
  }

  const removeTag = (t) => setTagList(prev => prev.filter(x => x !== t))

  const validate = () => {
    const e = {}
    if (!form.title.trim())    e.title    = 'Title is required'
    if (!form.content.trim())  e.content  = 'Prompt content is required'
    if (!form.category)        e.category = 'Please select a category'
    if (form.price && isNaN(Number(form.price))) e.price = 'Price must be a number'
    setErrors(e)
    return Object.keys(e).length === 0
  }

  const handleSubmit = async e => {
    e.preventDefault()
    if (!validate()) return
    setSubmitting(true)
    try {
      await promptAPI.create({
        ...form,
        price: form.price ? Number(form.price) : 0,
        tags: tagList,
      })
      toast.success('Prompt submitted for review!')
      navigate('/dashboard/my-prompts')
    } catch (err) {
      const data = err?.response?.data
      if (data?.errors) {
        setErrors(Object.fromEntries(Object.entries(data.errors).map(([k,v]) => [k, Array.isArray(v) ? v[0] : v])))
      }
      toast.error(data?.message || 'Failed to submit prompt')
    } finally {
      setSubmitting(false)
    }
  }

  const svgChevron = `url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19.5 8.25l-7.5 7.5-7.5-7.5'/%3E%3C/svg%3E") right 12px center/16px no-repeat, #fff`

  return (
    <div style={{ maxWidth:820, margin:'0 auto' }}>
      <style>{`
        @keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        @keyframes spin{to{transform:rotate(360deg)}}
        .ap-fade{animation:fadeUp .4s cubic-bezier(.16,1,.3,1) both;}
      `}</style>

      {/* Header */}
      <div className="ap-fade" style={{ position:'relative', overflow:'hidden', borderRadius:20, marginBottom:22, background:'linear-gradient(135deg,#0f0724 0%,#1e1060 40%,#3b1fa3 100%)', padding:'24px 28px' }}>
        <div style={{ position:'absolute', top:-40, right:-40, width:200, height:200, borderRadius:'50%', background:'rgba(139,92,246,.1)', pointerEvents:'none' }}></div>
        <div style={{ position:'relative' }}>
          <p style={{ fontSize:10, fontWeight:700, color:'rgba(199,210,254,.6)', textTransform:'uppercase', letterSpacing:'.2em', marginBottom:5 }}>Content Submission</p>
          <p style={{ fontSize:26, fontWeight:900, color:'#fff', lineHeight:1.2, letterSpacing:'-.4px' }}>Add New Prompt</p>
          <p style={{ fontSize:12.5, color:'rgba(196,181,253,.45)', marginTop:4 }}>Your submission will be reviewed before going live on the marketplace.</p>
        </div>
      </div>

      {/* Edit / Preview tabs */}
      <div style={{ display:'flex', gap:6, marginBottom:18, background:'#fff', padding:5, borderRadius:12, border:'1px solid #e5e9f0', width:'fit-content', boxShadow:'0 1px 6px rgba(0,0,0,.04)' }}>
        {['Edit', 'Preview'].map(tab => (
          <button key={tab} type="button" onClick={() => setPreview(tab === 'Preview')}
            style={{ padding:'7px 20px', borderRadius:9, fontSize:12.5, fontWeight:700, border:'none', cursor:'pointer', transition:'all .15s',
              background: (tab === 'Preview') === preview ? 'linear-gradient(135deg,#4f46e5,#7c3aed)' : 'transparent',
              color:       (tab === 'Preview') === preview ? '#fff' : '#94a3b8',
              boxShadow:   (tab === 'Preview') === preview ? '0 4px 12px rgba(99,102,241,.35)' : 'none',
            }}
          >{tab}</button>
        ))}
      </div>

      {preview ? (
        <div style={{ background:'#fff', borderRadius:18, border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)', overflow:'hidden' }}>
          <div style={{ height:4, background:'linear-gradient(135deg,#4f46e5,#8b5cf6)' }}></div>
          <div style={{ padding:28 }}>
            <div style={{ display:'flex', alignItems:'flex-start', gap:12, marginBottom:18 }}>
              <div style={{ flex:1 }}>
                <h2 style={{ fontSize:20, fontWeight:900, color:'#1e293b', lineHeight:1.3 }}>{form.title || 'Untitled Prompt'}</h2>
                <p style={{ fontSize:13, color:'#64748b', marginTop:5, lineHeight:1.6 }}>{form.description || 'No description provided.'}</p>
              </div>
              <span style={{ fontSize:14, fontWeight:800, color:'#059669' }}>
                {form.price ? `$${Number(form.price).toFixed(2)}` : 'Free'}
              </span>
            </div>
            <div style={{ display:'flex', gap:8, flexWrap:'wrap', marginBottom:16 }}>
              {form.category && <span style={{ fontSize:11, fontWeight:700, padding:'3px 10px', borderRadius:99, background:'#eef2ff', color:'#4f46e5' }}>{form.category}</span>}
              {form.ai_tool  && <span style={{ fontSize:11, fontWeight:700, padding:'3px 10px', borderRadius:99, background:'#f0fdf4', color:'#059669' }}>{form.ai_tool}</span>}
              {tagList.map(t => <span key={t} style={{ fontSize:11, fontWeight:600, padding:'3px 9px', borderRadius:99, background:'#f1f5f9', color:'#64748b' }}>#{t}</span>)}
            </div>
            {form.content && (
              <div style={{ background:'#0f172a', borderRadius:12, padding:'18px 20px' }}>
                <p style={{ fontSize:10, fontWeight:700, color:'#475569', textTransform:'uppercase', letterSpacing:'.15em', marginBottom:10 }}>Prompt Content</p>
                <pre style={{ fontSize:13, color:'#e2e8f0', whiteSpace:'pre-wrap', wordBreak:'break-word', margin:0, fontFamily:'ui-monospace,monospace', lineHeight:1.6 }}>{form.content}</pre>
              </div>
            )}
          </div>
        </div>
      ) : (
        <form onSubmit={handleSubmit}>
          <div style={{ display:'flex', flexDirection:'column', gap:14 }}>

            {/* Basic Info */}
            <div style={{ background:'#fff', borderRadius:18, border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)', overflow:'hidden' }}>
              <div style={{ padding:'16px 22px', borderBottom:'1px solid #f1f5f9', display:'flex', alignItems:'center', gap:10 }}>
                <div style={{ width:28, height:28, borderRadius:8, background:'linear-gradient(135deg,#4f46e5,#7c3aed)', display:'flex', alignItems:'center', justifyContent:'center' }}>
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                </div>
                <span style={{ fontSize:13.5, fontWeight:700, color:'#1e293b' }}>Basic Information</span>
              </div>
              <div style={{ padding:'20px 22px', display:'flex', flexDirection:'column', gap:14 }}>
                <Field label="Title" required error={errors.title}>
                  <input name="title" value={form.title} onChange={handleChange} placeholder="A clear, descriptive title for your prompt"
                    style={inputStyle(errors.title)}
                    onFocus={e => { if (!errors.title) e.target.style.borderColor='#6366f1' }}
                    onBlur={e => { if (!errors.title) e.target.style.borderColor='#e2e8f0' }}
                  />
                </Field>
                <Field label="Description" hint="A brief summary shown in search results">
                  <textarea name="description" value={form.description} onChange={handleChange}
                    placeholder="What does this prompt do? What problem does it solve?" rows={3}
                    style={{ ...inputStyle(false), resize:'vertical', fontFamily:'inherit' }}
                    onFocus={e => e.target.style.borderColor='#6366f1'}
                    onBlur={e => e.target.style.borderColor='#e2e8f0'}
                  />
                </Field>
                <div style={{ display:'grid', gridTemplateColumns:'1fr 1fr', gap:14 }}>
                  <Field label="Category" required error={errors.category}>
                    <select name="category" value={form.category} onChange={handleChange}
                      style={{ ...inputStyle(errors.category), appearance:'none', background:svgChevron }}
                      onFocus={e => e.target.style.borderColor='#6366f1'}
                      onBlur={e => e.target.style.borderColor='#e2e8f0'}
                    >
                      <option value="">Select category...</option>
                      {CATEGORIES.map(c => <option key={c} value={c}>{c}</option>)}
                    </select>
                  </Field>
                  <Field label="AI Tool" hint="Which AI this prompt is optimized for">
                    <select name="ai_tool" value={form.ai_tool} onChange={handleChange}
                      style={{ ...inputStyle(false), appearance:'none', background:svgChevron }}
                      onFocus={e => e.target.style.borderColor='#6366f1'}
                      onBlur={e => e.target.style.borderColor='#e2e8f0'}
                    >
                      <option value="">Any / Not specific</option>
                      {AI_TOOLS.map(t => <option key={t} value={t}>{t}</option>)}
                    </select>
                  </Field>
                </div>
              </div>
            </div>

            {/* Prompt Content */}
            <div style={{ background:'#fff', borderRadius:18, border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)', overflow:'hidden' }}>
              <div style={{ padding:'16px 22px', borderBottom:'1px solid #f1f5f9', display:'flex', alignItems:'center', gap:10 }}>
                <div style={{ width:28, height:28, borderRadius:8, background:'linear-gradient(135deg,#0284c7,#0891b2)', display:'flex', alignItems:'center', justifyContent:'center' }}>
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/></svg>
                </div>
                <span style={{ fontSize:13.5, fontWeight:700, color:'#1e293b' }}>Prompt Content</span>
                <span style={{ marginLeft:'auto', fontSize:11, color:'#94a3b8' }}>{form.content.length} chars</span>
              </div>
              <div style={{ padding:'20px 22px' }}>
                <Field label="Prompt Text" required error={errors.content} hint="The actual prompt text that users will copy and use. Use [BRACKETS] for variables.">
                  <textarea name="content" value={form.content} onChange={handleChange}
                    placeholder="Write your prompt here. Example: You are an expert [ROLE]. Your task is to [TASK]. Please ensure that [REQUIREMENT]..."
                    rows={10}
                    style={{ ...inputStyle(errors.content), resize:'vertical', fontFamily:'ui-monospace,monospace', fontSize:13, lineHeight:1.6 }}
                    onFocus={e => { if (!errors.content) e.target.style.borderColor='#6366f1' }}
                    onBlur={e => { if (!errors.content) e.target.style.borderColor='#e2e8f0' }}
                  />
                </Field>
              </div>
            </div>

            {/* Pricing & Tags */}
            <div style={{ background:'#fff', borderRadius:18, border:'1px solid #e5e9f0', boxShadow:'0 2px 12px rgba(0,0,0,.04)', overflow:'hidden' }}>
              <div style={{ padding:'16px 22px', borderBottom:'1px solid #f1f5f9', display:'flex', alignItems:'center', gap:10 }}>
                <div style={{ width:28, height:28, borderRadius:8, background:'linear-gradient(135deg,#059669,#0891b2)', display:'flex', alignItems:'center', justifyContent:'center' }}>
                  <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#fff" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z M6 6h.008v.008H6V6z"/></svg>
                </div>
                <span style={{ fontSize:13.5, fontWeight:700, color:'#1e293b' }}>Pricing & Tags</span>
              </div>
              <div style={{ padding:'20px 22px', display:'flex', flexDirection:'column', gap:14 }}>
                <div style={{ display:'grid', gridTemplateColumns:'1fr 1fr', gap:14 }}>
                  <Field label="Price (USD)" hint="Leave empty or 0 for free" error={errors.price}>
                    <div style={{ position:'relative' }}>
                      <span style={{ position:'absolute', left:13, top:'50%', transform:'translateY(-50%)', color:'#94a3b8', fontSize:13.5, fontWeight:600, pointerEvents:'none' }}>$</span>
                      <input name="price" value={form.price} onChange={handleChange} placeholder="0.00" type="number" min="0" step="0.01"
                        style={{ ...inputStyle(errors.price), paddingLeft:26 }}
                        onFocus={e => { if (!errors.price) e.target.style.borderColor='#6366f1' }}
                        onBlur={e => { if (!errors.price) e.target.style.borderColor='#e2e8f0' }}
                      />
                    </div>
                  </Field>
                  <div style={{ display:'flex', flexDirection:'column', justifyContent:'flex-end', paddingBottom:2 }}>
                    <label style={{ display:'flex', alignItems:'center', gap:10, cursor:'pointer', padding:'10px 14px', borderRadius:10, border:'1.5px solid #e2e8f0', transition:'border-color .15s' }}
                      onMouseEnter={e => e.currentTarget.style.borderColor='#6366f1'}
                      onMouseLeave={e => e.currentTarget.style.borderColor='#e2e8f0'}
                    >
                      <input type="checkbox" name="is_public" checked={form.is_public} onChange={handleChange}
                        style={{ width:15, height:15, accentColor:'#6366f1', cursor:'pointer' }}
                      />
                      <span style={{ fontSize:13, fontWeight:600, color:'#475569' }}>Make publicly visible</span>
                    </label>
                  </div>
                </div>

                <Field label="Tags" hint="Add up to 10 tags to help users discover your prompt (press Enter or comma to add)">
                  <div style={{ display:'flex', gap:8 }}>
                    <input value={tagInput} onChange={e => setTagInput(e.target.value)} placeholder="Add a tag..."
                      onKeyDown={e => { if (e.key === 'Enter') { e.preventDefault(); addTag() } if (e.key === ',') { e.preventDefault(); addTag() } }}
                      style={{ ...inputStyle(false), flex:1 }}
                      onFocus={e => e.target.style.borderColor='#6366f1'}
                      onBlur={e => e.target.style.borderColor='#e2e8f0'}
                    />
                    <button type="button" onClick={addTag}
                      style={{ padding:'10px 16px', borderRadius:10, fontSize:13, fontWeight:700, color:'#6366f1', background:'#eef2ff', border:'1.5px solid #e0e7ff', cursor:'pointer', whiteSpace:'nowrap', transition:'all .15s' }}
                      onMouseEnter={e => { e.currentTarget.style.background='linear-gradient(135deg,#4f46e5,#7c3aed)'; e.currentTarget.style.color='#fff'; e.currentTarget.style.borderColor='transparent' }}
                      onMouseLeave={e => { e.currentTarget.style.background='#eef2ff'; e.currentTarget.style.color='#6366f1'; e.currentTarget.style.borderColor='#e0e7ff' }}
                    >+ Add</button>
                  </div>
                  {tagList.length > 0 && (
                    <div style={{ display:'flex', flexWrap:'wrap', gap:6, marginTop:10 }}>
                      {tagList.map(t => (
                        <span key={t} style={{ display:'inline-flex', alignItems:'center', gap:5, padding:'4px 10px', borderRadius:99, fontSize:12, fontWeight:600, background:'#eef2ff', color:'#4f46e5', border:'1px solid #e0e7ff' }}>
                          #{t}
                          <button type="button" onClick={() => removeTag(t)} style={{ display:'flex', alignItems:'center', background:'none', border:'none', cursor:'pointer', color:'#818cf8', padding:0 }}>
                            <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                          </button>
                        </span>
                      ))}
                    </div>
                  )}
                </Field>
              </div>
            </div>

            {/* Submit */}
            <div style={{ display:'flex', alignItems:'center', justifyContent:'flex-end', gap:10, paddingBottom:8 }}>
              <button type="button" onClick={() => navigate('/dashboard/my-prompts')}
                style={{ padding:'10px 20px', borderRadius:10, fontSize:13, fontWeight:600, color:'#64748b', background:'#fff', border:'1.5px solid #e2e8f0', cursor:'pointer', transition:'all .15s' }}
                onMouseEnter={e => e.currentTarget.style.borderColor='#94a3b8'}
                onMouseLeave={e => e.currentTarget.style.borderColor='#e2e8f0'}
              >Cancel</button>
              <button type="submit" disabled={submitting}
                style={{ display:'flex', alignItems:'center', gap:7, padding:'10px 24px', borderRadius:10, fontSize:13.5, fontWeight:700, color:'#fff', border:'none', background:'linear-gradient(135deg,#4f46e5,#7c3aed)', cursor:submitting ? 'not-allowed' : 'pointer', opacity:submitting ? .7 : 1, boxShadow:'0 4px 16px rgba(99,102,241,.4)', transition:'all .15s' }}
                onMouseEnter={e => { if (!submitting) { e.currentTarget.style.transform='translateY(-1px)'; e.currentTarget.style.boxShadow='0 8px 24px rgba(99,102,241,.5)' }}}
                onMouseLeave={e => { e.currentTarget.style.transform='translateY(0)'; e.currentTarget.style.boxShadow='0 4px 16px rgba(99,102,241,.4)' }}
              >
                {submitting ? (
                  <>
                    <svg style={{ animation:'spin 1s linear infinite' }} width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                    Submitting...
                  </>
                ) : (
                  <>
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2.5"><path strokeLinecap="round" strokeLinejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Submit Prompt
                  </>
                )}
              </button>
            </div>
          </div>
        </form>
      )}
    </div>
  )
}
