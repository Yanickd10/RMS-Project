    
    //  import {cart} from 'newsdetails.js';
    //  console.log(`hello ${cart.length} items in cart`);
    // import { sharedData } from 'newsdetails.js';
    // console.log(window.sharedData);
     const newsItems = [{
            date: "April 25, 2025",
            title: "Spring Arts Festival Next Week yanick 2",
            excerpt: "Join us for our annual Spring Arts Festival featuring performances and exhibits from students across all grade levels.",
            link: "#"
        },
        {
            date: "April 20, 2025",
            title: "New Library Opens",
            excerpt: "The new library opens this weekend with a special ceremony and guest speakers.",
            link: "#"
        },
        {
            date: "April 15, 2025",
            title: "Sports Day Highlights",
            excerpt: "Highlights from last week's Sports Day, including winners and memorable moments.",
            link: "#"
        }
    ]
    document.getElementById('news').innerHTML = `News & Announcements (${newsItems.length})`;
    document.querySelector('.news-container').innerHTML = newsItems.map(item => `
        <article class="news-item">
            <div class="news-date">${item.date}</div>
            <h3 class="news-title">${item.title}</h3>
            <p class="news-excerpt">${item.excerpt}</p>
            <a href="${item.link}" class="read-more">Read more →</a>
        </article>
    `).join('');
    // Simple carousel functionality
    document.addEventListener('DOMContentLoaded', function() {
        const carouselContainer = document.querySelector('.carousel-container');
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const slideWidth = 100; // percentage
        let currentIndex = 0;
        // Initialize
        updateCarousel();
        // Setup automatic sliding
        setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            updateCarousel();
        }, 5000);
        // Add click events to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });

        function updateCarousel() {
            // Update slides position
            carouselContainer.style.transform = `translateX(-${currentIndex * slideWidth}%)`;
            // Update dots
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
    });
  
    document.addEventListener('DOMContentLoaded', function() {
        // DOM Elements
        const searchInput = document.getElementById('searchInput');
        const clearButton = document.getElementById('clearButton');
        const searchButton = document.getElementById('searchButton');
        const suggestionsContainer = document.getElementById('suggestionsContainer');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const searchResults = document.getElementById('searchResults');
        const searchContainer = document.getElementById('searchContainer');
        // Sample website content for search demonstration
        const webpageContent = [{
                title: "Home Page",
                content: "Welcome to our website. We offer various services and products.",
                url: "#home"
            },
            {
                title: "About Us",
                content: "Learn more about our company history and mission statement.",
                url: "#about"
            },
            {
                title: "Products",
                content: "Browse our wide range of products including electronics, clothing, and accessories.",
                url: "#products"
            },
            {
                title: "Services",
                content: "We provide top-notch customer service and support for all your needs.",
                url: "#services"
            },
            {
                title: "Contact",
                content: "Get in touch with our support team via email, phone, or visit our office.",
                url: "#contact"
            },
            {
                title: "Blog",
                content: "Read our latest articles on technology, fashion, and industry trends.",
                url: "#blog"
            },
            {
                title: "FAQ",
                content: "Find answers to frequently asked questions about our products and services.",
                url: "#faq"
            },
            {
                title: "Privacy Policy",
                content: "Information about how we collect, use, and protect your personal data.",
                url: "#privacy"
            },
            {
                title: "Terms of Service",
                content: "Details about the terms and conditions of using our website and services.",
                url: "#terms"
            },
        ];
        // Variables
        let searchTimeout;
        let hasSearched = false;
        // Event Listeners
        searchInput.addEventListener('input', handleInput);
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
        searchInput.addEventListener('focus', function() {
            if (searchInput.value.trim() !== '') {
                showSuggestions();
            }
        });
        clearButton.addEventListener('click', clearSearch);
        searchButton.addEventListener('click', performSearch);
        // Handle clicks outside the search container
        document.addEventListener('click', function(e) {
            if (!searchContainer.contains(e.target)) {
                suggestionsContainer.style.display = 'none';
            }
        });
        // Functions
        function handleInput() {
            const query = searchInput.value.trim();
            // Toggle clear button visibility
            clearButton.style.display = query ? 'block' : 'none';
            if (query === '') {
                suggestionsContainer.style.display = 'none';
                loadingIndicator.style.display = 'none';
                clearTimeout(searchTimeout);
                return;
            }
            // Show loading indicator
            loadingIndicator.style.display = 'block';
            suggestionsContainer.style.display = 'none';
            // Clear previous timeout
            clearTimeout(searchTimeout);
            // Set new timeout for search suggestions
            searchTimeout = setTimeout(() => {
                generateSuggestions(query);
            }, 300);
        }

        function generateSuggestions(query) {
            // Filter content based on query
            const filteredContent = webpageContent.filter(item =>
                item.title.toLowerCase().includes(query.toLowerCase()) ||
                item.content.toLowerCase().includes(query.toLowerCase())
            ).slice(0, 5);
            // Hide loading indicator
            loadingIndicator.style.display = 'none';
            // Show suggestions if there are any
            if (filteredContent.length > 0) {
                suggestionsContainer.innerHTML = '';
                filteredContent.forEach(item => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.className = 'suggestion-item';
                    const titleElement = document.createElement('div');
                    titleElement.className = 'suggestion-title';
                    titleElement.innerHTML = highlightMatch(item.title, query);
                    const contentElement = document.createElement('div');
                    contentElement.className = 'suggestion-content';
                    contentElement.innerHTML = highlightMatch(item.content.substring(0, 60) + '...',
                        query);
                    suggestionItem.appendChild(titleElement);
                    suggestionItem.appendChild(contentElement);
                    // Add click event to select suggestion
                    suggestionItem.addEventListener('click', function() {
                        selectSuggestion(item);
                    });
                    suggestionsContainer.appendChild(suggestionItem);
                });
                suggestionsContainer.style.display = 'block';
            } else {
                suggestionsContainer.style.display = 'none';
            }
        }

        function performSearch() {
            const query = searchInput.value.trim();
            if (query === '') return;
            // Filter content based on query
            const results = webpageContent.filter(item =>
                item.title.toLowerCase().includes(query.toLowerCase()) ||
                item.content.toLowerCase().includes(query.toLowerCase())
            );
            // Display results
            displaySearchResults(results, query);
            // Hide suggestions
            suggestionsContainer.style.display = 'none';
            hasSearched = true;
        }

        function displaySearchResults(results, query) {
            searchResults.innerHTML = '';
            // Create results title
            const resultsTitle = document.createElement('h2');
            resultsTitle.className = 'results-title';
            resultsTitle.textContent = `Search Results ${results.length > 0 ? `(${results.length})` : ''}`;
            searchResults.appendChild(resultsTitle);
            if (results.length > 0) {
                // Create results list
                results.forEach(result => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'result-item';
                    const resultLink = document.createElement('a');
                    resultLink.href = result.url;
                    resultLink.style.textDecoration = 'none';
                    const titleElement = document.createElement('h3');
                    titleElement.className = 'result-title';
                    titleElement.innerHTML = highlightMatch(result.title, query);
                    const contentElement = document.createElement('p');
                    contentElement.className = 'result-content';
                    contentElement.innerHTML = highlightMatch(result.content, query);
                    resultLink.appendChild(titleElement);
                    resultLink.appendChild(contentElement);
                    resultItem.appendChild(resultLink);
                    searchResults.appendChild(resultItem);
                });
            } else {
                // No results found
                const noResults = document.createElement('div');
                noResults.className = 'no-results';
                const noResultsMessage = document.createElement('p');
                noResultsMessage.className = 'no-results-message';
                noResultsMessage.textContent = `No results found for "${query}"`;
                const noResultsSuggestion = document.createElement('p');
                noResultsSuggestion.className = 'no-results-suggestion';
                noResultsSuggestion.textContent = 'Try using different keywords or check your spelling';
                noResults.appendChild(noResultsMessage);
                noResults.appendChild(noResultsSuggestion);
                searchResults.appendChild(noResults);
            }
            searchResults.style.display = 'block';
        }

        function selectSuggestion(suggestion) {
            searchInput.value = suggestion.title;
            displaySearchResults([suggestion], suggestion.title);
            suggestionsContainer.style.display = 'none';
            hasSearched = true;
        }

        function clearSearch() {
            searchInput.value = '';
            clearButton.style.display = 'none';
            suggestionsContainer.style.display = 'none';
            searchResults.style.display = 'none';
            hasSearched = false;
        }

        function showSuggestions() {
            const query = searchInput.value.trim();
            if (query !== '') {
                generateSuggestions(query);
            }
        }

        function highlightMatch(text, query) {
            if (!query) return text;
            const regex = new RegExp(`(${escapeRegExp(query)})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        }

        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }
    });
 
    const isInViewport = (element) => {
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.bottom >= 0
        );
    };
 
 
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            const targetElement = document.querySelector(targetId);
            const navHeight = document.querySelector('header').offsetHeight;
            window.scrollTo({
                top: targetElement.offsetTop - navHeight,
                behavior: 'smooth'
            });
        });
    });
 