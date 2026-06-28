import React, { useState, useEffect } from 'react'
import { motion } from 'framer-motion'
import { Link, useSearchParams } from 'react-router-dom'
import { promptAPI } from '../api'
import LoadingSpinner from '../components/LoadingSpinner'
import { toast } from 'react-toastify'

const container = {
  hidden: { opacity: 0 },
  show: {
    opacity: 1,
    transition: { staggerChildren: 0.1 },
  },
}

const item = {
  hidden: { opacity: 0, y: 20 },
  show: { opacity: 1, y: 0 },
}

export default function AllPromptsPage() {
  const [prompts, setPrompts] = useState([])
  const [isLoading, setIsLoading] = useState(true)
  const [searchParams, setSearchParams] = useSearchParams()

  useEffect(() => {
    const fetchPrompts = async () => {
      try {
        setIsLoading(true)
        const params = {
          search: searchParams.get('search') || '',
          category: searchParams.get('category') || '',
          ai_tool: searchParams.get('ai_tool') || '',
          difficulty: searchParams.get('difficulty') || '',
          sort: searchParams.get('sort') || 'latest',
          page: searchParams.get('page') || 1,
        }
        const response = await promptAPI.getAll(params)
        setPrompts(response.data.data.data || response.data.data)
      } catch (error) {
        toast.error('Failed to load prompts')
        console.error(error)
      } finally {
        setIsLoading(false)
      }
    }

    fetchPrompts()
  }, [searchParams])

  if (isLoading) return <LoadingSpinner />

  return (
    <div className="min-h-screen bg-gray-50">
      <div className="max-w-7xl mx-auto px-4 py-8">
        <h1 className="text-4xl font-bold text-gray-900 mb-8">All Prompts</h1>

        {/* Filters */}
        <div className="mb-8 bg-white p-6 rounded-lg shadow">
          <input
            type="text"
            placeholder="Search prompts..."
            defaultValue={searchParams.get('search') || ''}
            onChange={(e) => setSearchParams({ search: e.target.value })}
            className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Prompts Grid */}
        <motion.div
          variants={container}
          initial="hidden"
          animate="show"
          className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
          {prompts.map((prompt) => (
            <motion.div key={prompt.id} variants={item} className="bg-white rounded-lg shadow hover:shadow-lg transition">
              <div className="p-6">
                <h3 className="text-xl font-bold text-gray-900 mb-2">{prompt.title}</h3>
                <p className="text-gray-600 text-sm mb-4 line-clamp-2">{prompt.description}</p>

                <div className="flex items-center justify-between mb-4">
                  <span className="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">
                    {prompt.category}
                  </span>
                  <span className="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                    {prompt.ai_tool}
                  </span>
                </div>

                <div className="text-sm text-gray-500 mb-4">
                  <p>by {prompt.user.name}</p>
                  <p>{prompt.copy_count} copies</p>
                </div>

                <Link
                  to={`/prompts/${prompt.id}`}
                  className="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-center block"
                >
                  View Details
                </Link>
              </div>
            </motion.div>
          ))}
        </motion.div>

        {prompts.length === 0 && (
          <div className="text-center py-12">
            <p className="text-gray-500 text-lg">No prompts found. Try adjusting your filters.</p>
          </div>
        )}
      </div>
    </div>
  )
}
