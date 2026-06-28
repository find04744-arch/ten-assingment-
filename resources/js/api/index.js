import axiosInstance from './axiosInstance'

// Prompt APIs
export const promptAPI = {
  getAll: (params) => axiosInstance.get('/prompts', { params }),
  getFeatured: () => axiosInstance.get('/prompts/featured'),
  getTrending: () => axiosInstance.get('/prompts/trending'),
  getTopCreators: () => axiosInstance.get('/prompts/top-creators'),
  getById: (id) => axiosInstance.get(`/prompts/${id}`),
  create: (data) => axiosInstance.post('/prompts', data),
  update: (id, data) => axiosInstance.put(`/prompts/${id}`, data),
  delete: (id) => axiosInstance.delete(`/prompts/${id}`),
  getUserPrompts: () => axiosInstance.get('/prompts/my-prompts'),
  incrementCopy: (id) => axiosInstance.post(`/prompts/${id}/copy`),
}

// Review APIs
export const reviewAPI = {
  getPromptReviews: (promptId) => axiosInstance.get(`/prompts/${promptId}/reviews`),
  getUserReviews: () => axiosInstance.get('/user/reviews'),
  create: (promptId, data) => axiosInstance.post(`/prompts/${promptId}/review`, data),
  update: (id, data) => axiosInstance.put(`/reviews/${id}`, data),
  delete: (id) => axiosInstance.delete(`/reviews/${id}`),
}

// Bookmark APIs
export const bookmarkAPI = {
  getAll: () => axiosInstance.get('/user/bookmarks'),
  toggle: (promptId) => axiosInstance.post(`/prompts/${promptId}/bookmark`),
}

// Payment APIs
export const paymentAPI = {
  createCheckout: (data) => axiosInstance.post('/payments/create-checkout', data),
  getHistory: () => axiosInstance.get('/payments/history'),
}

// User APIs
export const userAPI = {
  getProfile: () => axiosInstance.get('/user/profile'),
  updateProfile: (data) => axiosInstance.put('/user/profile', data),
  getDashboardStats: () => axiosInstance.get('/user/dashboard-stats'),
}

// Dashboard APIs
export const dashboardAPI = {
  getUserStats: () => axiosInstance.get('/dashboard/stats'),
  getUserAnalytics: () => axiosInstance.get('/dashboard/analytics'),
  getCreatorDashboard: () => axiosInstance.get('/creator/dashboard'),
  getCreatorAnalytics: () => axiosInstance.get('/creator/analytics'),
  getCreatorPrompts: () => axiosInstance.get('/creator/prompts'),
}

// Admin APIs
export const adminAPI = {
  getDashboard: () => axiosInstance.get('/admin/dashboard'),
  getAnalytics: () => axiosInstance.get('/admin/analytics'),
  getUsers: (page = 1) => axiosInstance.get('/admin/users', { params: { page } }),
  updateUserRole: (userId, role) => axiosInstance.put(`/admin/users/${userId}/role`, { role }),
  deleteUser: (userId) => axiosInstance.delete(`/admin/users/${userId}`),
  getPrompts: (page = 1) => axiosInstance.get('/admin/prompts', { params: { page } }),
  approvePrompt: (promptId) => axiosInstance.put(`/admin/prompts/${promptId}/approve`),
  rejectPrompt: (promptId, feedback) => axiosInstance.put(`/admin/prompts/${promptId}/reject`, { feedback }),
  deletePrompt: (promptId) => axiosInstance.delete(`/admin/prompts/${promptId}`),
  featurePrompt: (promptId) => axiosInstance.put(`/admin/prompts/${promptId}/feature`),
  getPayments: (page = 1) => axiosInstance.get('/admin/payments', { params: { page } }),
  getReports: (page = 1) => axiosInstance.get('/admin/reports', { params: { page } }),
  resolveReport: (reportId) => axiosInstance.put(`/admin/reports/${reportId}/resolve`),
  dismissReport: (reportId) => axiosInstance.put(`/admin/reports/${reportId}/dismiss`),
  warnCreator: (reportId) => axiosInstance.post(`/admin/reports/${reportId}/warn-creator`),
}

// Report API
export const reportAPI = {
  create: (promptId, data) => axiosInstance.post(`/prompts/${promptId}/report`, data),
}
