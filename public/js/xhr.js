/**
 * @param {string} method the method of the request
 * @param {string} url the url to make the request to
 * @return a promise of request
 */
function xhr(method, url, token = null) {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();
		xhr.open(method, url + (token ? "?_token=" + token : ""), true);
		xhr.onload = () => {
			if (xhr.status >= 200 && xhr.status < 300) {
				resolve(xhr.response);
			} else {
				reject({
					status: xhr.status,
					statusText: xhr.statusText,
				});
			}
		};
		xhr.onerror = () => {
			reject({
				status: xhr.status,
				statusText: xhr.statusText,
			});
		};
		xhr.send();
	});
}
