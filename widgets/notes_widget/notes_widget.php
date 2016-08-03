<script src="./tinymce/js/tinymce/tinymce.min.js"></script>
	<script>
		tinymce.init({
		selector: "div.new_note",
		theme: "modern",
		plugins: [
			["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
			["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
			["save table contextmenu directionality emoticons template paste"]
		],
		add_unload_trigger: false,
		schema: "html5",
		inline: true,
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image     | print preview media",
		statusbar: false
	});

	tinymce.init({
		selector: "h1.note_title",
		theme: "modern",
		add_unload_trigger: false,
		schema: "html5",
		inline: true,
		toolbar: "undo redo",
		statusbar: false
	});
	</script> 
<div class="widget_header"></div>
<div class="main_sec">
	<h1 class="note_title">Title</h1>
	<div class="new_note">New Note</div>
</div>