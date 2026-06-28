import React, { useEffect } from 'react'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import { ToastContainer } from 'react-toastify'
import 'react-toastify/dist/ReactToastify.css'

// Layouts
import MainLayout from './layouts/MainLayout'
import DashboardLayout from './layouts/DashboardLayout'

// Pages
import HomePage from './pages/HomePage'
import AllPromptsPage from './pages/AllPromptsPage'
import PromptDetailsPage from './pages/PromptDetailsPage'
import LoginPage from './pages/LoginPage'
import RegisterPage from './pages/RegisterPage'
import PaymentPage from './pages/PaymentPage'
import NotFoundPage from './pages/NotFoundPage'

// Dashboard Pages
import UserDashboard from './pages/dashboard/UserDashboard'
import AddPromptPage from './pages/dashboard/AddPromptPage'
import MyPromptsPage from './pages/dashboard/MyPromptsPage'
import SavedPromptsPage from './pages/dashboard/SavedPromptsPage'
import MyReviewsPage from './pages/dashboard/MyReviewsPage'
import ProfilePage from './pages/dashboard/ProfilePage'
import CreatorDashboard from './pages/dashboard/CreatorDashboard'
import AdminDashboard from './pages/dashboard/AdminDashboard'

// Store
import { useAuthStore } from './store/authStore'

function App() {
  const { initializeAuth } = useAuthStore()

  useEffect(() => {
    initializeAuth()
  }, [])

  return (
    <Router>
      <Routes>
        {/* Public Routes */}
        <Route element={<MainLayout />}>
          <Route path="/" element={<HomePage />} />
          <Route path="/prompts" element={<AllPromptsPage />} />
          <Route path="/prompts/:id" element={<PromptDetailsPage />} />
          <Route path="/login" element={<LoginPage />} />
          <Route path="/register" element={<RegisterPage />} />
          <Route path="/payment" element={<PaymentPage />} />
        </Route>

        {/* Dashboard Routes */}
        <Route element={<DashboardLayout />}>
          <Route path="/dashboard" element={<UserDashboard />} />
          <Route path="/dashboard/add-prompt" element={<AddPromptPage />} />
          <Route path="/dashboard/my-prompts" element={<MyPromptsPage />} />
          <Route path="/dashboard/saved-prompts" element={<SavedPromptsPage />} />
          <Route path="/dashboard/my-reviews" element={<MyReviewsPage />} />
          <Route path="/dashboard/profile" element={<ProfilePage />} />
          <Route path="/creator-dashboard" element={<CreatorDashboard />} />
          <Route path="/admin-dashboard" element={<AdminDashboard />} />
        </Route>

        {/* 404 Page */}
        <Route path="*" element={<NotFoundPage />} />
      </Routes>

      <ToastContainer
        position="top-right"
        autoClose={3000}
        hideProgressBar={false}
        newestOnTop={true}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
      />
    </Router>
  )
}

export default App
