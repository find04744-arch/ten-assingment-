import create from 'zustand'
import axiosInstance from '../api/axiosInstance'

export const useAuthStore = create((set, get) => ({
  user: null,
  token: null,
  isAuthenticated: false,
  isLoading: false,

  initializeAuth: () => {
    const token = localStorage.getItem('token')
    if (token) {
      set({ token, isAuthenticated: true })
    }
  },

  login: async (email, password) => {
    set({ isLoading: true })
    try {
      const response = await axiosInstance.post('/auth/login', { email, password })
      const { token, user } = response.data
      localStorage.setItem('token', token)
      set({ user, token, isAuthenticated: true })
      return response.data
    } catch (error) {
      throw error
    } finally {
      set({ isLoading: false })
    }
  },

  register: async (name, email, password) => {
    set({ isLoading: true })
    try {
      const response = await axiosInstance.post('/auth/register', {
        name,
        email,
        password,
        password_confirmation: password,
      })
      const { token, user } = response.data
      localStorage.setItem('token', token)
      set({ user, token, isAuthenticated: true })
      return response.data
    } catch (error) {
      throw error
    } finally {
      set({ isLoading: false })
    }
  },

  logout: async () => {
    try {
      await axiosInstance.post('/auth/logout')
    } catch (error) {
      console.error('Logout error:', error)
    } finally {
      localStorage.removeItem('token')
      set({ user: null, token: null, isAuthenticated: false })
    }
  },

  googleLogin: async (name, email, photo_url, google_id) => {
    set({ isLoading: true })
    try {
      const response = await axiosInstance.post('/auth/google', {
        name,
        email,
        photo_url,
        google_id,
      })
      const { token, user } = response.data
      localStorage.setItem('token', token)
      set({ user, token, isAuthenticated: true })
      return response.data
    } catch (error) {
      throw error
    } finally {
      set({ isLoading: false })
    }
  },

  updateUser: (user) => set({ user }),
}))
