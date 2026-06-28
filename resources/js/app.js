import './bootstrap';

// Form submission handlers
document.addEventListener('DOMContentLoaded', function() {
    // Handle bookmark toggle
    const bookmarkButtons = document.querySelectorAll('[data-bookmark-btn]');
    bookmarkButtons.forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const promptId = this.dataset.promptId;
            try {
                const response = await fetch(`/prompts/${promptId}/bookmark`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                });
                if (response.ok) {
                    this.classList.toggle('text-red-500');
                    this.classList.toggle('text-gray-400');
                }
            } catch (error) {
                console.error('Error bookmarking prompt:', error);
            }
        });
    });

    // Handle review form submission
    const reviewForm = document.getElementById('review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const promptId = this.dataset.promptId;
            try {
                const response = await fetch(`/prompts/${promptId}/review`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: formData
                });
                if (response.ok) {
                    this.reset();
                    location.reload();
                }
            } catch (error) {
                console.error('Error submitting review:', error);
            }
        });
    }

    // Search and filter
    const filterForm = document.getElementById('filter-form');
    if (filterForm) {
        const searchInput = filterForm.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('change', function() {
                filterForm.submit();
            });
        }
    }
});
