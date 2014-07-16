if (typeof RedactorPlugins === 'undefined') var RedactorPlugins = {};

RedactorPlugins.advanced = {

	init: function()
	{
		this.buttonAddAfter('link', 'advanced', 'Advanced', this.insertAdvancedHtml);
	},
	insertAdvancedHtml: function()
	{
		this.insertHtml('<b>It\'s awesome!</b> ');
	}

}