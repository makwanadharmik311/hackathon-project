function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        {
            pageLanguage: 'en',
            includedLanguages: 'gu,en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 
        'google_translate_element'
    );

    // Set Gujarati as the default language
    setTimeout(() => {
        let selectElement = document.querySelector(".goog-te-combo");
        if (selectElement) {
            selectElement.value = "gu"; // Set Gujarati
            selectElement.dispatchEvent(new Event("change"));
        }
    }, 3000); // Wait for the translator to load
}

function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    if (sidebar.style.left === "0px") {
        sidebar.style.left = "-250px";
    } else {
        sidebar.style.left = "0px";
    }
}



// document.addEventListener("DOMContentLoaded",function(){
//     document.querySelectorAll(".wishlist-btn").forEach(button => {
//         button.addEventListener("click", function(){
//             let productId = this.getAttribute("data-id");
//             alert("Added to wishlist!!" + productId);
//         });
//     });
// });
/*
document.addEventListener("DOMContentLoaded", function () {
    let searchForm = document.getElementById("searchForm");
    let searchInput = document.getElementById("searchQuery");
    let resultsDiv = document.getElementById("searchResults");
    let clearButton = document.getElementById("clearSearch"); // ✅ Select the Clear Button

    if (!searchForm || !searchInput || !resultsDiv || !clearButton) {
        console.error("Search form or clear button not found. Ensure it's loaded correctly.");
        return;
    }

    // 🔍 Search Form Submit Event
    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let query = searchInput.value.trim();
        console.log("Sending query:", query);

        if (query.length > 0) {
            performSearch(query);
        } else {
            console.log("Empty search query");
        }
    });

    // 🧹 Clear Search Button Event
    clearButton.addEventListener("click", function () {
        console.log("Clearing search..."); // Debugging log
        searchInput.value = ""; // ✅ Clear input field
        resultsDiv.innerHTML = ""; // ✅ Clear search results
    });
});

function performSearch(query) {
    let resultsDiv = document.getElementById("searchResults");
    resultsDiv.innerHTML = "<p>Loading...</p>";

    fetch("/SGH%202025/search.php?q=" + encodeURIComponent(query)) // ✅ Fixed Path
        .then(response => response.json())
        .then(data => {
            console.log("Response received:", data);
            resultsDiv.innerHTML = "";

            if (data.length > 0) {
                data.forEach(craft => {
                    resultsDiv.innerHTML += `
                        <div style="border:1px solid #ddd; padding:10px; margin:5px;">
                            <h3>${craft.name}</h3>
                            <p>${craft.description}</p>
                            <p>Price: $${craft.price}</p>
                            <p>Stock: ${craft.stock}</p>
                            <img src="${craft.image_url}" alt="${craft.name}" width="100">
                            ${craft.model_url ? <br><a href="${craft.model_url}" target="_blank">View 3D Model</a> : ""}
                        </div>`;
                });
            } else {
                resultsDiv.innerHTML = "<p>No results found</p>";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            resultsDiv.innerHTML = "<p>Something went wrong. Try again.</p>";
        });
}
*/
/*
document.addEventListener("DOMContentLoaded", function () {
    let searchForm = document.getElementById("searchForm");
    let searchInput = document.getElementById("searchQuery");
    let resultsDiv = document.querySelector("main #searchResults"); // ✅ Select results inside <main>
    let clearButton = document.getElementById("clearSearch"); 

    if (!searchForm || !searchInput || !resultsDiv || !clearButton) {
        console.error("Search form or clear button not found. Ensure it's loaded correctly.");
        return;
    }

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let query = searchInput.value.trim();
        console.log("Sending query:", query);

        if (query.length > 0) {
            performSearch(query);
        } else {
            console.log("Empty search query");
        }
    });

    clearButton.addEventListener("click", function () {
        console.log("Clearing search...");
        searchInput.value = ""; 
        resultsDiv.innerHTML = ""; 
    });
});

function performSearch(query) {
    let resultsDiv = document.querySelector("main #searchResults"); // ✅ Ensure results go inside <main>
    resultsDiv.innerHTML = "<p>Loading...</p>";

    fetch("/SGH%202025/search.php?q=" + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            console.log("Response received:", data);
            resultsDiv.innerHTML = "";

            if (data.length > 0) {
                data.forEach(craft => {
                    resultsDiv.innerHTML += `
                        <div style="border:1px solid #ddd; padding:10px; margin:5px;">
                            <h3>${craft.name}</h3>
                            <p>${craft.description}</p>
                            <p>Price: $${craft.price}</p>
                            <p>Stock: ${craft.stock}</p>
                            <img src="${craft.image_url}" alt="${craft.name}" width="100">
                            ${craft.model_url ? <br><a href="${craft.model_url}" target="_blank">View 3D Model</a> : ""}
                        </div>`;
                });
            } else {
                resultsDiv.innerHTML = "<p>No results found</p>";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            resultsDiv.innerHTML = "<p>Something went wrong. Try again.</p>";
        });
}

*/

document.addEventListener("DOMContentLoaded", function () {
    alert("Searching..");
    let searchContainer = document.querySelector(".search-container"); // ✅ Select the search div
    let searchForm = searchContainer ? searchContainer.querySelector("#searchForm") : null;
    let searchInput = searchContainer ? searchContainer.querySelector("#searchQuery") : null;
    let resultsDiv = document.querySelector("main #searchResults"); // ✅ Select results inside <main>
    let clearButton = searchContainer ? searchContainer.querySelector("#clearSearch") : null;

    if (!searchForm || !searchInput || !resultsDiv || !clearButton) {
        console.error("Search form or clear button not found. Ensure it's loaded correctly.");
        return;
    }

    // 🔍 Search Form Submit Event
    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let query = searchInput.value.trim();
        console.log("Sending query:", query);
        if (query.length > 0) {
            performSearch(query);
        } else {
            console.log("Empty search query");
        }
    });

    // 🧹 Clear Search Button Event
    clearButton.addEventListener("click", function () {
        console.log("Clearing search...");
        searchInput.value = "";
        resultsDiv.innerHTML = ""; // ✅ Clear search results inside <main>
    });
});

function performSearch(query) {
    let resultsDiv = document.querySelector("main #searchResults"); // ✅ Ensure results go inside <main>
    resultsDiv.innerHTML = "<p>Loading...</p>";

    fetch("/php_e-commerce/search.php?q=" + encodeURIComponent(query))
        .then(response => response.json())
        .then(data => {
            console.log("Response received:", data);
            resultsDiv.innerHTML = "";
            if (data.length > 0) {
                data.forEach(craft => {
                    //${craft.model_url ? <br><a href="${craft.model_url}" target="_blank">View 3D Model</a> : ""}   insert this after img src
                    resultsDiv.innerHTML += `
                        <div style="border:1px solid #ddd; padding:10px; margin:5px;">
                            <h3>${craft.name}</h3>
                            <p>${craft.description}</p>
                            <p>Price: $${craft.price}</p>
                            <p>Stock: ${craft.stock}</p>
                            <img src="${craft.image_url}" alt="${craft.name}" width="100">;
                            </div>`;
                        
                }
            );
            } else {
                resultsDiv.innerHTML = "<p>No results found</p>";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            resultsDiv.innerHTML = "<p>Something went wrong. Try again.</p>";
        });
}