let database;
const Services = {
	start: function () {
		const xhr = new XMLHttpRequest(),
				cls = Services.db.getClass('current');
		xhr.open('GET', '/api/stream/view/' + cls)
		xhr.onload = function (event) {
			postMessage(JSON.parse(xhr.response).data)
			setTimeout('Services.start()', 25000)
		};
		xhr.send();
	}
};

Services.db = {
	init: function () {
		let db = indexedDB.open('db', 3)
		db.onupgradeneeded = this.onUpgrade
		db.onsuccess = this.onSuccess
		db.onerror = this.onError
	},
	getClass: function (key) {
		let dateResult = 'default';
		if (typeof database === "undefined") return dateResult
		const transaction = database.transaction('class', 'readonly'),
				dbStore = transaction.objectStore('class'),
				request = dbStore.get(key);
		request.onsuccess = function (event) {
			const value = event.target.result
			if (value) dateResult = value
		}
		return dateResult
	},
	setClass: function (key, value) {
		if (typeof database === "undefined") return
		const transaction = database.transaction('class', 'readwrite'),
				dbStore = transaction.objectStore('class');
		dbStore.add(value, key)
	},
	onUpgrade: function (event) {
		database = event.target.result
		database.createObjectStore('class')
	},
	onSuccess: function (event) {
		database = event.target.result
		Services.db.setClass('current', 'default')
	},
	onError: function (event) {
		console.log(event.target.errorCode)
	}
}

Services.start()
Services.db.init()
onmessage = function (e) {
	Services.db.setClass('current', e.data)
}
