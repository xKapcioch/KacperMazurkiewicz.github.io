<?php
/** @var \App\Model\Aktor $aktor */

?>
<div class="form-group">
    <label for="nickname">Imię lub pseudonim</label>
    <input type="text" id="nickname" name="aktor[nickname]"
           value="<?= $aktor->getNickname() ?? '' ?>">
</div>
<div class="form-group">
    <label for="description">Opis i występy u Norbiego</label>
    <textarea id="description" name="aktor[description]"><?= $aktor->getDescription() ?? '' ?></textarea>
</div>
<div class="form-group">
    <label for="video_url">Link do filmu (opcjonalnie)</label>
    <input type="text" id="video_url" name="aktor[video_url]" placeholder="https://www.youtube.com/watch?v=..."
           value="<?= $aktor->getVideoUrl() ?>">
</div>
<div class="form-group">
    <span></span>
    <input type="submit" value="Zapisz">
</div>