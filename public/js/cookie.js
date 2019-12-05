function getCookie(cookieName) {
    return decodeURIComponent(document.cookie)
        .split(';')
        .map((cookie) => {
            return cookie.trim();
        })
        .filter((cookie) => {
            return cookie.startsWith(cookieName + "=");
        })
        .map((cookie) => {
            return cookie.substring((cookieName + "=").length, cookie.length);
        })[0] || "";
}

function setCookie(cookieName, cookieValue, expirationTime) {
    document.cookie = `${cookieName}=${cookieValue};expires=${(new Date() + (expirationTime * 24 * 60 * 60 * 1000)).toGMTString()};path=/`;
}
