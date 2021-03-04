<div class="col-xs-12">
    <div class="form-group">
        <label class="control-label mainlabel" for="newTag">Теги</label>
        <div class='lk_userinfobtn'>
            <? 
						$val = isset($value)? $value: '';
						$textTags = isset($text)? $text: ''; // удалить?

						$APPLICATION->IncludeComponent(
							"bitrix:search.tags.input",
							"tagsInAddNews",
							array(
								"VALUE" => $val,
								"NAME" => "PROPERTY[TAGS][0]",
								"TEXT" => $text, // удалить?
							), null, array("HIDE_ICONS"=>"Y")
						);
?>
        </div>
    </div>

    <input type="text" class="newTags" id="newTag" value="">
    <div class="btn btn-blue btnplus minbr addTag" id='addNewTag'>
        <span class="plus text-center">+</span>Добавить тег
    </div>

    <script type="text/javascript">
        $('#addNewTag').on('click', function() {
            var newTag = $('#newTag').val();
            if ('' != newTag && ' ' != newTag && !!newTag[0] && ' ' != newTag[0]) {
                var existsTags = $('.search-tags').val();
                $('#newTag').val('');
                $('.tagsList').append('<span class="tag btn btn-blue-full minbr">#' + newTag + '</span>');

                console.log('et', existsTags[0]);
                if ('' != existsTags && ' ' != existsTags && !!existsTags[0] && ' ' != existsTags[0])
                    $('.search-tags').val(existsTags + ', ' + newTag);
                else
                    $('.search-tags').val(newTag);
            }
        });

        $('.tagsList').on('click', '.tag', function() { //  доделать удаление тегов 
            var tag = $(this).text() + ',';
            var existsTags = $('.search-tags').val() + ',';

            existsTags = existsTags.replace(new RegExp(tag, 'g'), '');
            var pos = existsTags.lastIndexOf(',');
            $('.search-tags').val(existsTags.slice(0, pos));
            $(this).remove();
        });
    </script>
</div> 