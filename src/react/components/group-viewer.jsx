/**
 * Display log in group view
 */
wplv.GroupViewer = React.createClass({

	// Get default properties
	getDefaultProps: function() {
		return {
			entries: []
		};
	},

	// Property types
	propTypes: {
		entries: React.PropTypes.array
	},

	// Render component
	render: function() {
		var groups = {};
		var groupContent = [];

		this.props.entries.forEach(function(entry) {
			var key = md5(entry.message);

			if (groups[key] === undefined) {
				groups[key] = {
					date: new Date(entry.date + ' ' + entry.time + ' ' + entry.timezone),
					message: entry.message,
					line: entry.line,
					errorType: entry.errorType,
					filePath: entry.filePath,
					entries: []
				};
			}

			groups[key].entries.push(entry);
		}.bind(this));

		for (var key in groups) {
			groupContent.push((
				<wplv.GroupEntry group={ groups[key] } />
			));
		}

		if (groupContent.length === 0) {
			groupContent = (
				<p>No entries found.</p>
			);
		}

		return (
			<div className="group-entries">
				{ groupContent }
			</div>
		);
	}
});