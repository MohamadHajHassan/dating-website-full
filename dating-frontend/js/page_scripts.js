const dating_pages = {};

dating_pages.baseURL = "http://127.0.0.1:8000/api/v0.1";

// Custom console
dating_pages.Console = (title, values, oneValue = true) => {
    console.log(`--- ${title} ---`);
    if (oneValue) {
        console.log(values);
    } else {
        for (let i = 0; i < values.length; i++) {
            console.log(values[i]);
        }
    }
    console.log(`--/ ${title} ---`);
};

// Get API
dating_pages.getAPI = async api_url => {
    try {
        return await axios(api_url);
    } catch (error) {
        dating_pages.Console("Error from GET API", error);
    }
};

// Post API
dating_pages.postAPI = async (api_url, api_data, api_token = null) => {
    try {
        return await axios.post(api_url, api_data, {
            headers: {
                Authorization: `token ${api_token}`,
            },
        });
    } catch (error) {
        dating_pages.Console("Error from POST API", error);
    }
};

// Load page
dating_pages.loadFor = page => {
    eval(`dating_pages.load_${page}();`);
};

dating_pages.load_register = async () => {
    // Variables
    const register_url = `${dating_pages.baseURL}/register`;
    const login_url = `${dating_pages.baseURL}/login`;

    const register_signin_btn = document.getElementById("register-signin-btn");
    const login_register_btn = document.getElementById("login-register-btn");
    const signin_dialog = document.getElementById("signin-dialog");
    const register_btn = document.getElementById("register-btn");
    const login_btn = document.getElementById("login-btn");
    const email_login = document.getElementById("email-login");
    const password_login = document.getElementById("password-login");
    const name_input = document.getElementById("name");
    const location_input = document.getElementById("location");
    const gender_input = document.getElementById("gender");
    const intrest_input = document.getElementById("intrest");
    const email_input = document.getElementById("email");
    const password_input = document.getElementById("password");
    const password_confirmation_input = document.getElementById(
        "password-confirmation"
    );
    const register_data = {
        name: name_input.value,
        location: location_input.value,
        email: email_input.value,
        password: password_input.value,
        password_confirmation: password_confirmation_input.value,
        gender: gender_input.value,
        intrested_in: intrest_input.value,
        age: "",
        bio: "",
        picture: "",
        visible: "1",
    };
    const login_data = {
        email: email_login.value,
        password: password_login.value,
    };

    // Functions
    const openLoginDialog = () => {
        signin_dialog.showModal();
        document.body.style.overflow = "hidden";
        signin_dialog.classList.remove("hidden");
    };

    const closeLoginDialog = () => {
        signin_dialog.close();
        document.body.style.overflow = "auto";
        signin_dialog.classList.add("hidden");
    };

    //
    register_signin_btn.addEventListener("click", e => {
        e.preventDefault();
        openLoginDialog();
    });

    login_register_btn.addEventListener("click", e => {
        e.preventDefault();
        closeLoginDialog();
    });

    register_btn.addEventListener("click", e => {
        e.preventDefault();
        const response_register = dating_pages.postAPI(
            register_url,
            register_data
        );
        dating_pages.Console("Register api", response_register.data);
    });

    login_btn.addEventListener("click", e => {
        e.preventDefault();
        const response_login = dating_pages.postAPI(login_url, login_data);
        dating_pages.Console("Login api", response_login.data);
    });
};

dating_pages.load_landing = async () => {
    // Variables
    const fetch_landing_url = `${dating_pages.baseURL}/auth/fetch-landing`;

    const profile_1 = document.getElementById("profile1");
    const profile_2 = document.getElementById("profile2");
    const close_modal = document.getElementById("close-modal");
    const modal = document.getElementById("modal");
    const chat_page = document.getElementById("chat-page");
    const feed_page = document.getElementById("feed-page");
    const favorites_page = document.getElementById("favorites-page");
    const feed_page_btn = document.getElementById("feed-page-btn");
    const favorites_page_btn = document.getElementById("favorites-page-btn");
    const chat_page_btn = document.getElementById("chat-page-btn");
    const js_pages = document.querySelectorAll(".js-pages");
    const js_nav = document.querySelectorAll(".js-nav");

    // Functions
    const openModal = () => {
        modal.showModal();
        document.body.style.overflow = "hidden";
        document.body.style.userSelect = "none";
    };

    const closeModal = () => {
        modal.close();
        document.body.style.overflow = "auto";
        document.body.style.userSelect = "auto";
    };

    const openFeed = () => {
        js_pages.forEach(page => {
            page.classList.add("not-visible");
        });
        feed_page.classList.remove("not-visible");
        js_nav.forEach(nav => {
            nav.classList.remove("nav-selected");
        });
        feed_page_btn.classList.add("nav-selected");
    };

    const openChat = () => {
        js_pages.forEach(page => {
            page.classList.add("not-visible");
        });
        chat_page.classList.remove("not-visible");
        js_nav.forEach(nav => {
            nav.classList.remove("nav-selected");
        });
        chat_page_btn.classList.add("nav-selected");
    };

    const openFavorites = () => {
        js_pages.forEach(page => {
            page.classList.add("not-visible");
        });
        favorites_page.classList.remove("not-visible");
        js_nav.forEach(nav => {
            nav.classList.remove("nav-selected");
        });
        favorites_page_btn.classList.add("nav-selected");
    };

    const fetchLanding = () => {
        const users = dating_pages.getAPI(fetch_landing_url);
        let cards = ``;
        users.data.map(values => {
            cards += `
            <a id="${values.id}" class="flex-column card">
                <img src="${values.picture}" alt="" />
                <p>${values.name}</p>
                <p>${values.location}</p>
            </a>`;
        });
        feed_page.innerHTML = cards;
    };

    //
    profile_1.addEventListener("click", e => {
        e.preventDefault();
        openModal();
    });

    profile_2.addEventListener("click", e => {
        e.preventDefault();
        openModal();
    });

    close_modal.addEventListener("click", e => {
        e.preventDefault();
        closeModal();
    });

    feed_page_btn.addEventListener("click", e => {
        e.preventDefault();
        openFeed();
    });

    favorites_page_btn.addEventListener("click", e => {
        e.preventDefault();
        openFavorites();
    });

    chat_page_btn.addEventListener("click", e => {
        e.preventDefault();
        openChat();
    });

    fetchLanding();
};
