<?php
$this->title = \Yii::$app->id . ' - About';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a name="reference"></a>
            <div <?php if (Yii::$app->user->can('edit') || Yii::$app->user->can('manage')) : ?>id="reference-editor" contenteditable="true"<?php endif; ?>>
                <?= $content["reference-editor"]; ?>
            </div>
            <br>
            <a name="citation-policy"></a>
            <div <?php if (Yii::$app->user->can('edit') || Yii::$app->user->can('manage')) : ?>id="citation-policy-editor" contenteditable="true"<?php endif; ?>>         
                <?= $content["citation-policy-editor"]; ?>
            </div>
            <br>

            <a name="support"></a>
            <div <?php if (Yii::$app->user->can('edit') || Yii::$app->user->can('manage')) : ?>id="support-editor" contenteditable="true"<?php endif; ?>>
                <?= $content["support-editor"]; ?>
            </div>
            <br>

            <a name="news-updates"></a>
            <div <?php if (Yii::$app->user->can('edit') || Yii::$app->user->can('manage')) : ?>id="news-updates-editor" contenteditable="true"<?php endif; ?>>
                <?= $content["news-updates-editor"]; ?>
            </div>
            <br>

            <a name="help"></a>
            <div <?php if (Yii::$app->user->can('edit') || Yii::$app->user->can('manage')) : ?>id="help-editor" contenteditable="true"<?php endif; ?>>
                <?= $content["help-editor"]; ?>
            </div>
            <br>
            <br>
        </div>
<?php if (Yii::$app->user->can('edit') || Yii::$app->user->can('manage')) : ?>
        <script>
            function saveEditorContents(editor) {
                var containerId = editor.container.getId();
                document.getElementById(containerId).dataset.savedHTML = editor.getData();  // Save current editor contents in data attribute 
            }

            function restoreEditorContents(editor) {
                var containerId = editor.container.getId(),
                    dataset = document.getElementById(containerId).dataset;
                if (dataset.savedHTML) {                          // Make sure contents were actually saved
                    editor.setData(dataset.savedHTML);               // Restore editor contents from data attribute
                }
            }

            CKEDITOR.on('instanceCreated', function (event) {
                event.editor.on("focus", function () {
                    saveEditorContents(event.editor);
                });
            });
        </script>
<?php endif; ?>
    </div>
</div>

