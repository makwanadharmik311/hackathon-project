// Handle form switching between login and signup
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => container.classList.add("active"));
loginBtn.addEventListener('click', () => container.classList.remove("active"));

// Language Toggle Functionality
let isEnglish = true;
function toggleLanguage() {
    const languageButton = document.getElementById("language-toggle");

    // Define translations for English & Gujarati
    const translations = {
        en: {
            signupHeader: "Create Account",
            signinHeader: "Sign In",
            signupOr: "or use your email for registration",
            signinOr: "or use your email and password",
            forgotPassword: "Forgot Your Password?",
            backWelcome: "Welcome Back!",
            backDetails: "Enter your personal details to use all of site features",
            helloFriend: "Hello, Friend!",
            friendDetails: "Register with your personal details to use all of site features",
            signupButton: "Sign Up",
            signinButton: "Sign In",
            languageText: "ગુજરાતી",
        },
        gu: {
            signupHeader: "ખાતું બનાવો",
            signinHeader: "સાઇન ઇન કરો",
            signupOr: "અથવા રજીસ્ટ્રેશન માટે તમારું ઇમેલ ઉપયોગ કરો",
            signinOr: "અથવા તમારું ઇમેલ અને પાસવર્ડ ઉપયોગ કરો",
            forgotPassword: "તમારો પાસવર્ડ ભૂલ્યા છો?",
            backWelcome: "પછીથી આવો!",
            backDetails: "તમારા વ્યક્તિગત વિગતો દાખલ કરો બધા વેબસાઇટ ફીચરનો ઉપયોગ કરવા માટે",
            helloFriend: "હેલો, મિત્રો!",
            friendDetails: "તમારા વ્યક્તિગત વિગતો સાથે રજીસ્ટર કરો બધો સાઇટ ફીચરનો ઉપયોગ કરવા માટે",
            signupButton: "સાઇન અપ કરો",
            signinButton: "સાઇન ઇન કરો",
            loginGoogle: "ગૂગલ સાથે લોગિન કરો",
            signUpGoogle: "ગૂગલ સાથે સાઇન અપ કરો",
            languageText: "English",
        }
    };

    // Toggle text based on language state
    const lang = isEnglish ? "gu" : "en";
    document.getElementById("signup-header").textContent = translations[lang].signupHeader;
    document.getElementById("signin-header").textContent = translations[lang].signinHeader;
    document.getElementById("signup-or").textContent = translations[lang].signupOr;
    document.getElementById("signin-or").textContent = translations[lang].signinOr;
    document.getElementById("forgot-password").textContent = translations[lang].forgotPassword;
    document.getElementById("back-welcome").textContent = translations[lang].backWelcome;
    document.getElementById("back-details").textContent = translations[lang].backDetails;
    document.getElementById("hello-friend").textContent = translations[lang].helloFriend;
    document.getElementById("friend-details").textContent = translations[lang].friendDetails;
    document.getElementById("signup-button").textContent = translations[lang].signupButton;
    document.getElementById("signin-button").textContent = translations[lang].signinButton;
    //document.getElementById("logGoogle").textContent = translations[lang].loginGoogle;
    languageButton.textContent = translations[lang].languageText;

    isEnglish = !isEnglish; // Toggle language state
}

// Toggle Login Page for Seller/User
function toggleLoginPage() {
    const slider = document.getElementById("login-slider");
    document.getElementById("signin-header").textContent = slider.checked ? "Seller Sign In" : "Sign In";
    document.getElementById("signup-header").textContent = slider.checked ? "Seller Registration" : "Create Account";
}

// Password Hide/Show Functionality
function togglePassword(inputId, icon) {
    const passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
