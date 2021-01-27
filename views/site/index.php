<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'SysID database';
?>
<div class="container">
    <div class="row" style="margin-top: 20px">
        <div class="col-lg-3" style="height: 580px">
            <table class="main-buttons" style="height: 100%; width: 100%; max-width: 560px;margin: auto auto">                        
                <tbody>                            
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/overview" >Overview</a></td></tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/human-gene-info" >Human gene info</a></td></tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/fly-gene-info" >Fly gene info</a></td></tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/disease-info" >Disease info</a></td> </tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/orthology" >Orthology</a></td> </tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/neuronal-screen" >Neuronal screen</a></td></tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/wing-screen" >Wing screen</a></td></tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/transcription-factor" >Transcription factors</a></td> </tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/motif" >Motifs</a></td></tr>
                    <tr><td class="main-button"><a href="<?= Url::base(); ?>/table/human-gene-info" id="sfari">Autism candidate genes (SFARI)</a></td></tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6" style="height: 580px">
            <div id="outer-picture" style="height: 560px;">
                <div id="inner-picture-severity">
                    <div id="inner-picture" style="height: 529.2px; width: 529.2px;">                        
                        <div class="squer" id="All">
                        </div>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer clickable super-class" id="SWSM">
                            <h3>SWSM</h3>
                            <p>(syndromic with structural malformations of organs/brain/limbs)</p>
                        </a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer clickable super-class" id="SWOSM">
                            <h3>SWOSM</h3> 
                            <p>(syndromic without structural malformations)</p>
                        </a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer clickable super-class" id="NS">
                            <h3>NS</h3> 
                            <p>(non-syndromic)</p>
                        </a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer clickable super-class" id="CS">
                            <h3>CS</h3> 
                            <p>(classic ID, moderate to severe, fully penetrant)</p>
                        </a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class1">1</a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class2">2</a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class3">3</a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer clickable super-class" id="CM">
                            <h3>CM</h3>
                            <p>(classic ID, either mild/borderline or moderate or very variable)</p>
                        </a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class4">4</a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class5">5</a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class6">6</a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer clickable super-class" id="NC">
                            <h3>NC</h3>
                            <p>(non-classic ID, either atypical or only rare of minor aspects)</p>
                        </a>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class7">7</a>
                        <div class="squer mc-center" id="Class8">
                            <a href="<?= Url::base(); ?>/table/overview" class="squer-border mc-text clickable" id="Class8a" style="border-radius: 28px 0px 0px 28px;">8a</a>
                            <a href="<?= Url::base(); ?>/table/overview" class="squer-border mc-text clickable" id="Class8b" style="border-radius: 0px 28px 28px 0px;">8b</a>
                        </div>
                        <a href="<?= Url::base(); ?>/table/overview" class="squer squer-border mc-center mc-text clickable" id="Class9">9</a>                       
                    </div> 
                </div>
            </div>
        </div>
        <div id="ac-classes-table" class="col-lg-3" style="height: 580px;font-size: 91.15%;">
            <table style="height: 100%;width: 100%;max-width: 560px;margin: auto auto">
                <thead>
                    <tr><th>Letter</th><th>Feature(s) or organ system</th></tr>
                </thead>                            
                <tbody>                            
                    <tr><td>A</td><td><div>short stature</div></td></tr>
                    <tr><td>B</td><td><div>microcephaly</div></td></tr>
                    <tr><td>C</td><td><div>lethality</div></td></tr>
                    <tr><td>E</td><td><div>epilepsy</div></td></tr>
                    <tr><td>F</td><td><div>overgrowth/macrocephaly</div></td></tr>
                    <tr><td>G</td><td><div>progression/regression</div></td></tr>
                    <tr><td>H</td><td><div>neurological symptoms</div></td></tr>
                    <tr><td>I</td><td><div>malignancies</div></td></tr>
                    <tr><td>J</td><td><div>immunological anomalies</div></td></tr>
                    <tr><td>K</td><td><div>endocrine anomalies</div></td></tr>
                    <tr><td>L</td><td><div class="rowspan2">L1: brain malformations</div><div class="rowspan2">L2: non-structural MRI anomalies</div></td></tr>
                    <tr><td>M</td><td><div>metabolic/mitochondrial anomalies</div></td></tr>
                    <tr><td>N</td><td><div>obesity</div></td></tr>
                    <tr><td>O</td><td><div>vegetative anomalies</div></td></tr>
                    <tr><td>P</td><td><div>behavioral anomalies</div></td></tr>
                    <tr><td>Q</td><td><div>myopathy (or muscular anomalies)</div></td></tr>
                    <tr><td>R</td><td><div>blood cell anomalies</div></td></tr>
                    <tr><td>S</td><td><div>ectodoermal anomalies</div></td></tr>
                    <tr><td>T</td><td><div>eye anomalies</div></td></tr>
                    <tr><td>U</td><td><div class="rowspan4">U: skeletal anomalies</div><div class="rowspan4">Ua: limb anomalies</div><div class="rowspan4">Ub: vertebral/skull anomalies</div><div class="rowspan4">Uc: clefts</div></td></tr>
                    <tr><td>V</td><td><div>cardiac malformations</div></td></tr>
                    <tr><td>W</td><td><div>urogenital and renal anomalies</div></td></tr>
                    <tr><td>X</td><td><div>other malformations</div></td></tr>                                
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 40px; text-align:center;">
        <div class="col-lg-12">
            <p id="update-info">With the latest update on <?= $updateInfo["lastUpdate"] ;?> SysID currently contains: <a href="<?= Url::base(); ?>/table/overview"><?= $updateInfo["primaryGenes"] ;?> primary ID genes</a>, <a href="<?= Url::base(); ?>/table/overview"><?= $updateInfo["candidateGenes"] ;?> candidate ID genes</a></p>
        </div>
    </div>
    <div id="logos" class="row">
        <a href="http://www2.cmbi.ru.nl/groups/comparative-genomics/research/" target='_blank'><img src="<?= Url::base(); ?>/images/Cmbi.gif" alt="CMBI" id="cmbi"></a>    
        <a href="https://www.radboudumc.nl/Research/Organisationofresearch/Departments/HumanGenetics/Pages/Drosophila_models_of_Brain_Disorders_home.aspx" target='_blank'><img src="<?= Url::base(); ?>/images/HGN.jpg" alt="Human Genetic Nijmegen" id="hgn"></a>
        <a href="https://www.radboudumc.nl" target='_blank'><img src="<?= Url::base(); ?>/images/Radboudumc.png" alt="Radboudumc" id="radboud"></a>
        <a href="http://www.gencodys.eu/" target='_blank'><img src="<?= Url::base(); ?>/images/Gencodys.png" alt="Genecodys" id="gencodys"></a>
    </div>
</div>

<script src="<?= Url::base(); ?>/js/welcome.js" ></script>
