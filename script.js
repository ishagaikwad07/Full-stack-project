document.addEventListener('DOMContentLoaded', function() {
  const popularButton = document.querySelector('[data-bs-target="#popular"]'); // Make sure it's targeting the correct button

  // Add event listener to switch tab and fetch data when 'Most Popular' is clicked
  popularButton.addEventListener('click', function() {
    fetchArticles('most popular');  // This will trigger the fetch for the "Most Popular" category
  });

  // Function to fetch articles by category
  function fetchArticles(category) {
    fetch('api.php?category=' + category)  // Make sure you pass the category to the server
      .then(response => response.json())
      .then(data => {
        if (data.status === "success") {
          const articlesContainer = document.querySelector('.content');

          // Clear existing content before rendering new articles
          articlesContainer.innerHTML = '';

          data.articles.forEach(article => {
            const articleCard = `
              <div class="card shadow-sm mb-4">
                <div class="card-body">
                  <h3 class="card-title">${article.title}</h3>
                  <p class="text-muted">By ${article.author} | ${article.publish_date}</p>
                  <p>${article.content}</p>
                </div>
              </div>
            `;
            articlesContainer.innerHTML += articleCard;
          });
        } else {
          console.log('Error fetching articles:', data.message);
        }
      })
      .catch(error => console.error("Error fetching articles:", error));
  }
});
