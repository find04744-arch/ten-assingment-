import React from 'react'
import { Link } from 'react-router-dom'
import { motion } from 'framer-motion'

export default function HomePage() {
  return (
    <div className="min-h-screen bg-gradient-to-b from-blue-50 to-white">
      {/* Hero Section */}
      <motion.section
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        className="max-w-7xl mx-auto px-4 py-20 text-center"
      >
        <h1 className="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
          Discover & Share AI Prompts
        </h1>
        <p className="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
          Join a community of creators sharing powerful AI prompts for ChatGPT, Gemini, Claude, and more.
        </p>

        <div className="flex justify-center gap-4">
          <Link
            to="/prompts"
            className="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-lg font-bold"
          >
            Explore Prompts
          </Link>
          <Link
            to="/register"
            className="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition text-lg font-bold"
          >
            Get Started
          </Link>
        </div>
      </motion.section>

      {/* Features Section */}
      <motion.section
        initial={{ opacity: 0 }}
        whileInView={{ opacity: 1 }}
        className="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-3 gap-8"
      >
        <div className="text-center">
          <div className="text-4xl mb-4">📝</div>
          <h3 className="text-xl font-bold text-gray-900 mb-2">Create</h3>
          <p className="text-gray-600">Create and publish your own AI prompts to share with the community.</p>
        </div>

        <div className="text-center">
          <div className="text-4xl mb-4">🔍</div>
          <h3 className="text-xl font-bold text-gray-900 mb-2">Discover</h3>
          <p className="text-gray-600">Find trending prompts and explore content from top creators.</p>
        </div>

        <div className="text-center">
          <div className="text-4xl mb-4">💬</div>
          <h3 className="text-xl font-bold text-gray-900 mb-2">Engage</h3>
          <p className="text-gray-600">Rate, review, and bookmark prompts you love.</p>
        </div>
      </motion.section>

      {/* CTA Section */}
      <motion.section
        initial={{ opacity: 0 }}
        whileInView={{ opacity: 1 }}
        className="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-12 text-center"
      >
        <h2 className="text-3xl font-bold mb-4">Ready to start sharing?</h2>
        <Link
          to="/register"
          className="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition font-bold"
        >
          Sign Up Free Today
        </Link>
      </motion.section>
    </div>
  )
}
