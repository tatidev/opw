<?php
function link_reps($text){
    return "<a class='oz-color' href='" . site_url("showrooms") . "'>".$text."</a>";
}
function link_cleanings($text){
    return "<a class='oz-color' href='" . site_url("") . "'>".$text."</a>";
}
function link_fabrics($text){
    return "<a class='oz-color' href='" . site_url("collection/viewall") . "'>".$text."</a>";
}
function link_tel($text){
    return "<a class='oz-color' href='tel:+01-323-549-3489'>323-549-3489</a>";
}

$codes = [
    [
        "code" => "B",
        "description" => "Bleach Cleanable",
    ],
    [
        "code" => "DC",
        "description" => "Dry Clean Only",
    ],
    [
        "code" => "S",
        "description" => "Clean only with dry cleaning solvent. Do not saturate. Do not use water. Pile textiles may require brushing to restore appearance.",
    ],
    [
        "code" => "W",
        "description" => "Clean only with water-based shampoo or foam upholstery cleaner. Do not over wet. Do not use solvents to spot clean. Pile textiles may require brushing to restore appearance.",
    ],
    [
        "code" => "WS",
        "description" => "Spot Clean with upholstery shampoo, foam from a mild detergent or mild dry-cleaning solvent. Do not saturate with liquid. Pile textiles may require brushing to restore appearance.",
    ],
    [
        "code" => "X",
        "description" => "Do not clean with either water or solvent-based cleaner. Use vacuuming or light brushing only.",
    ],
    [
        "code" => "Others",
        "description" => "Please contact <a class='oz-color' href='mailto:info@opuzen.com'>Opuzen Customer Service</a> for detailed cleaning instructions."
    ]
];
$bottomLine = "Cleaning codes and cleaning information are provided for reference only – be sure to test clean your fabric according to instructions provided in a small area first. Opuzen will not guarantee results. Cleaning information and recommendations are given without warranty. Please consult a cleaning professional for optimal results.";
?>



<div style="margin: 22px 30px 0 41px;">
    <div class="sections-subtitles-h2" style='color:white;'>Opuzen Fabric Cleaning</div>
    <br/>
    <div class="sections-subtitles-h4" style='color:white;'>Cleaning Code Definitions</div>
    <br/>
    <br/>
    <table>
        <?php
        foreach($codes as $c){
            $code = $c['code'];
            $description = $c['description'];
            echo "
                <tr>
                    <td>$code</td>
                    <td width='90%'>$description</td>
                </tr>
            ";
        }
        ?>
    </table>
    <br/>
    <br/>
    <p>
        <?=$bottomLine;?>
    </p>
</div>

<!--<div style="margin: 22px 30px 0 41px;">-->
<!--    <p class="faq-q oz-color btnSpec">What size are samples?</p>-->
<!--    <p class="faq-a bkgr-black text-white">The standard upholstery memo (sample) size is 12” x 12”, and a drapery/sheer memo size: 18” x 18”</p>-->
<!--</div>-->


<style>
    p, td {
        color: white;
    }


    ul {
        padding-left: 13px;
    }

    a:hover {
        color: white!important;
    }
</style>
