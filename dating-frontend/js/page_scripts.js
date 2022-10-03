const dating_pages = {};

dating_pages.baseURL = "";

// Custom console
dating_pages.Console = (title, values, oneValue = true) => {
    console.log(`--- title ---`);
    if (oneValue) {
        console.log(values);
    } else {
        for (let i = 0; i < values.length; i++) {
            console.log(values[i]);
        }
    }
    console.log(`--/ title ---`);
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
    const register_signin_btn = document.getElementById("register-signin-btn");
    const login_register_btn = document.getElementById("login-register-btn");
    const signin_dialog = document.getElementById("signin-dialog");

    register_signin_btn.addEventListener("click", e => {
        e.preventDefault();
        openLoginDialog();
    });

    login_register_btn.addEventListener("click", e => {
        e.preventDefault();
        closeLoginDialog();
    });

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
};
