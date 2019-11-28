/**
 * @param {string} method the method of the request
 * @param {string} url the url to make the request to
 * @param {object} headers the headers to add to the request
 * @param {object} formDatas the datas in the form to send
 * @return a promise of request
 */
function xhr(method, url, headers = {}, formDatas = {}) {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();
		xhr.open(method, url, true);
		for(const header in headers) {
			xhr.setRequestHeader(header, headers[header]);
		}
		const formData = new FormData();
		for(const data in formDatas) {
			formData.append(data, formDatas[data]);
		}
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
		xhr.send(formData);
	});
}
