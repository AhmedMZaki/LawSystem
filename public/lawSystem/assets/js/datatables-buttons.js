(function(window, document, $, undefined) {
	function flattenJson(data, name, flattened) {
		if (!flattened) {
			flattened = {};
		}

		if (!name) {
			name = '';
		}

		if ($.isPlainObject(data) || $.isArray(data)) {
			$.each(data, function(idx, val) {
				if (name === '') {
					flattenJson(val, idx, flattened);
				} else {
					flattenJson(val, name + '[' + idx + ']', flattened);
				}
			});
		} else {
			flattened[name] = data;
		}

		return flattened;
	}

	$.fn.dataTable.ext.buttons.download = {
		text: 'Download',
		action: function(e, dt, node, config) {
			// Gather information to be submitted
			var data = {};

			if (dt.page.info().serverSide) {
				$.extend(data, dt.ajax.params());
			}

			if (typeof config.data === 'function') {
				config.data(data);
			} else if (typeof config.data === 'object') {
				$.extend(data, config.data);
			}

			// Convert data to a flat structure for submission
			var flattened = flattenJson(data);

			// Create an iframe
			var iframe = $('<iframe/>')
				.css({
					border: 'none',
					height: 0,
					width: 0
				})
				.appendTo(document.body);

			var contentDoc = iframe[0].contentWindow.document;
			contentDoc.open();
			contentDoc.close();

			var form = $('<form/>', contentDoc)
				.attr('method', config.type)
				.attr('action', config.url)
				.appendTo(contentDoc.body);

			$.each(flattened, function(name, val) {
				$('<input/>', contentDoc)
					.attr('type', 'text')
					.attr('name', name)
					.attr('autocomplete', 'no')
					.val(val)
					.appendTo(form);
			});

			form.submit();
		},
		url: '',
		type: 'POST',
		data: {}
	};
})(window, document, jQuery);
