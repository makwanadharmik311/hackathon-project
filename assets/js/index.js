document.addEventListener("DOMContentLoaded", () => {
    const languageSelect = document.getElementById("language");

    // Load language preference from localStorage
    const savedLang = localStorage.getItem("selectedLanguage") || "en";
    languageSelect.value = savedLang;
    switchLanguage(); // Apply saved language

    languageSelect.addEventListener("change", () => {
        localStorage.setItem("selectedLanguage", languageSelect.value);
        switchLanguage();
    });
});

function switchLanguage() {
    const lang = document.getElementById("language").value;

    // Header text
    document.getElementById("welcome-text").textContent =
        lang === "gu" ? "અમારી વેબસાઇટમાં આપનું સ્વાગત છે!" : "Welcome to our Website!";

    // Search input placeholder
    document.getElementById("search-input").placeholder =
        lang === "gu" ? "શોધો..." : "Search...";

    // Navigation links
    document.querySelectorAll("nav ul li a").forEach(link => {
        link.textContent = lang === "gu" ? link.getAttribute("data-gu") : link.getAttribute("data-en");
    });

    // Introduction section
    document.getElementById("intro-title").textContent =
        lang === "gu" ? "આદિવાસી કળાની સુંદરતા શોધો" : "Discover the Beauty of Tribal Arts";

    document.getElementById("intro-text").innerHTML =
        lang === "gu"
            ? "આદિવાસી કલા પેઢીઓથી ચાલતી આવી છે. <br> અમારી પ્લેટફોર્મ પર પ્રામાણિક, હસ્તકલા દ્વારા તૈયાર કરાયેલ આદિવાસી કલા પ્રદર્શિત થાય છે, <br> જે સંસ્કૃતિ અને સર્જનાત્મકતાને પ્રતિબિંબિત કરે છે.<br><br> દરેક કલા એક વાર્તા કહે છે, જે પ્રેમ અને સમર્પણથી બનાવવામાં આવી છે.<br> આદિવાસી કલા ખરીદી દ્વારા, તમે પ્રાચીન પરંપરાઓને જાળવી રાખી શકો છો <br> અને પ્રતિભાશાળી કલાકારોને સશક્ત બનાવી શકો છો."
            : "Explore the rich heritage of tribal arts, passed down through generations.<br> Our platform showcases authentic, handcrafted tribal artwork that reflects deep-rooted traditions, culture, and creativity.<br><br> Every piece tells a story, crafted with love and devotion.<br> By purchasing tribal art, you help sustain age-old traditions and empower talented artisans.";

    // Buttons
    document.getElementById("learn-more-btn").textContent = lang === "gu" ? "વધુ જાણો →" : "Learn More →";
    document.getElementById("login-btn").textContent = lang === "gu" ? "પ્રવેશ કરો" : "Login";
    document.getElementById("signup-btn").textContent = lang === "gu" ? "સાઇન અપ કરો" : "Sign Up";

    // Product Section
    document.querySelector(".similar-products h2").textContent =
        lang === "gu" ? "અમારા ઉત્પાદનો:" : "Our Products:";

    const products = [
        { id: "saree", en: "Saree", gu: "સાડી" },
        { id: "bag", en: "Handmade Bag", gu: "હસ્તકલા બેગ" },
        { id: "carving", en: "Wooden Carving", gu: "લાકડાનું કોતરણ" }
    ];

    document.querySelectorAll(".product-card").forEach((card, index) => {
        card.querySelector(".product-name").textContent =
            lang === "gu" ? products[index].gu : products[index].en;

        card.querySelector(".add-to-cart").textContent =
            lang === "gu" ? "કાર્ટમાં ઉમેરો" : "Add to Cart";
    });
}

// Countdown Timer
function startCountdown() {
    let timeLeft = 3 * 24 * 60 * 60; // 3 days in seconds
    const daysEl = document.getElementById("days");
    const hoursEl = document.getElementById("hours");
    const minutesEl = document.getElementById("minutes");
    const secondsEl = document.getElementById("seconds");

    function updateTimer() {
        let days = Math.floor(timeLeft / (24 * 60 * 60));
        let hours = Math.floor((timeLeft % (24 * 60 * 60)) / (60 * 60));
        let minutes = Math.floor((timeLeft % (60 * 60)) / 60);
        let seconds = timeLeft % 60;

        daysEl.textContent = days;
        hoursEl.textContent = hours;
        minutesEl.textContent = minutes;
        secondsEl.textContent = seconds;

        if (timeLeft > 0) {
            timeLeft--;
            setTimeout(updateTimer, 1000);
        }
    }

    updateTimer();
}

startCountdown();

// Product Slider Scroll
function scrollSlider(direction) {
    document.querySelector(".product-container").scrollBy({
        left: direction * 250,
        behavior: "smooth",
    });
}

