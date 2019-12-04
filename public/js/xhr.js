/**
 * @param {string} method the method of the request
 * @param {string} url the url to make the request to
 * @param {object} headers the headers to add to the request
 * @param {object} formDatas the datas in the form to send
 * @return a promise of request
 */
function xhr(method, url, headers = {}, formDatas = {}) {
    return new Promise((resolve, reject) => {
        const xmlHttpRequest = new XMLHttpRequest();
        xmlHttpRequest.open(method, url, true);
        for (const header in headers) {
            xmlHttpRequest.setRequestHeader(header, headers[header]);
        }
        xmlHttpRequest.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xmlHttpRequest.setRequestHeader("Accept", "application/json");
        // xmlHttpRequest.setRequestHeader("Authorization", "Bearer " + token);
        xmlHttpRequest.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name=api_token]').content);
        const formData = new FormData();
        for (const data in formDatas) {
            formData.append(data, formDatas[data]);
        }
        xmlHttpRequest.onload = () => {
            if (xmlHttpRequest.status >= 200 && xmlHttpRequest.status < 300) {
                resolve(xmlHttpRequest);
            } else {
                reject(xmlHttpRequest);
            }
        };
        xmlHttpRequest.onerror = () => {
            reject(xmlHttpRequest);
        };
        xmlHttpRequest.send(formData);
    });
}
