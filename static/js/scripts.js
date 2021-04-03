if (typeof jQuery === "undefined") throw new Error("jQuery plugins need to be before this file");

jQuery(function ($) {
	'use strict';

	let worker;

	$.Apps = {};
	$.Apps.Worker = {
		activate: function () {
			if (typeof Worker !== "undefined") {
				worker = new Worker("static/js/worker.js")
				worker.onmessage = this.load
				$.Apps.Element.activate()
			} else alert("No Web Worker support.")
		},
		load: function (messageEvent) {
			const currentEl = [], newEl = [],
					container = document.getElementById('container'),
					videoWidth = (window.innerWidth - (5 * 7)) / 8, videoHeight = videoWidth * 640 / 480
			container.style.gridTemplateColumns = 'repeat(auto-fill, minmax(' + videoWidth + 'px, 1fr))'
			container.style.gridTemplateRows = 'repeat(auto-fill, minmax(' + videoHeight + 'px, 1fr))'
			for (let i = 0; i < container.childNodes.length; i++)
				currentEl.push(container.childNodes[i].id)
			$.each(messageEvent.data, function(i, stream) {
				if (!document.body.contains(document.getElementById(stream.name))) {
					const iframe = document.createElement('iframe'),
							baseUrl = 'https://live.afcode.id/LiveApp/play.html?name='
					iframe.setAttribute('src', baseUrl + stream.name)
					iframe.setAttribute('width', videoWidth)
					iframe.setAttribute('height', videoHeight)
					iframe.setAttribute('frameBorder', 0)
					iframe.setAttribute('id', stream.name)
					container.append(iframe)
				}
				newEl.push(stream.name)
			});
			$.each(currentEl.filter(x => !newEl.includes(x)), function (i, vid) {
				container.removeChild(document.getElementById(vid))
			});
		}
	}
	$.Apps.Element = {
		activate: function () {
			const selectClass = $('select#select-class')
			selectClass.change(function () { worker.postMessage($(this).val()) })
			$.get('/api/class', function (result) {
				selectClass.append(new Option('Semua Kelas', 'default'))
				$.each(result.data, function (i, v) { selectClass.append(new Option(v.name, v.initial)) })
			})
		}
	}

	$(document).ready(function () {
		$.Apps.Worker.activate()
	})
}(jQuery));