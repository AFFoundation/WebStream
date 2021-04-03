let cls = 'default';
const Services = {
	start: function () {
		const xhr = new XMLHttpRequest()
		xhr.open('GET', '/api/stream/view/' + cls)
		xhr.onload = function (event) {
			postMessage(JSON.parse(xhr.response).data)
			setTimeout('Services.start()', 15000)
		};
		xhr.send();
	}
};

Services.start()
onmessage = function (e) { cls = e.data }
