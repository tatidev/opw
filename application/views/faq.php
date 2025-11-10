<?php
function link_reps($text){
    return "<a class='oz-color' href='" . site_url("showrooms") . "'>".$text."</a>";
}
function link_cleanings($text){
    return "<a class='oz-color' href='" . site_url("cleanings") . "'>".$text."</a>";
}
function link_fabrics($text){
    return "<a class='oz-color' href='" . site_url("collection/viewall") . "'>".$text."</a>";
}
function link_tel($text){
    return "<a class='oz-color' href='tel:+01-323-549-3489'>323-549-3489</a>";
}
$faq = [
    [
        "categoryName" => "Samples",
        "categoryQuestions" => [
            [
                "q" => "What size are samples?",
                "a" => "The standard upholstery memo (sample) size is 12” x 12”, and a drapery/sheer memo size: 18” x 18”."
            ],
            [
                "q" => "How do I order samples?",
                "a" => "<ul><li>Email your request to <a class='oz-color' href='mailto:warehousesampling@opuzen.com'>warehousesampling@opuzen.com</a></li><li>Contact your local Sales Rep, find your local rep ".link_reps("here").".</li><li>Call Opuzen at ".link_tel("")." to speak with a customer service representative.</li></ul>"
            ],
            [
                "q" => "Do I need to pay for samples and a shipping charge?",
                "a" => "<ul><li>Opuzen sends samples at no charge to you.</li><li>Our standard shipping method is FedEx 2 day for domestic U.S. addresses.</li><li>If expedited shipping is required, you will be asked to provide a freight account or pay for the freight charges up front.</li><li>For sample requests outside the U.S., a freight account is required (FedEx, UPS, DHL).</li></ul>"
            ],
            [
                "q" => "Where can I see samples in person?",
                "a" => "Find your nearest Showroom ".link_reps("here")."!"
            ]
        ]
    ],
    [
        "categoryName" => "FABRICS",
        "categoryQuestions" => [
            [
                "q" => "Are Custom colors available?",
                "a" => "Most patterns are available in a custom color. Note that minimum quantities may be required to order custom color weaving. Please contact your ".link_reps("Sales Rep")." for more information."
            ],
            [
                "q" => "Is your fabric machine washable?",
                "a" => "Fabrics vary in their cleaning instructions. Cleaning codes or special notes will be listed in fabric specifications included with orders and found on Product detail pages in the ".link_fabrics("Fabrics section").". Definitions of Cleaning Codes can be found on the ".link_cleanings("Fabric Cleaning page")."."
            ],
            [
                "q" => "Are your fabrics stain resistant?",
                "a" => "Some fabrics are inherently stain-resistant, while others need to be treated. The specifications will note if a fabric comes stain-resistant."
            ],
            [
                "q" => "Are there other finish treatments available for the fabrics? What’s the lead-time?",
                "a" => "Other treatments can be applied such as Knit back & flame resistant. Treatments generally add 7-10 business days to lead time. Contact your Sales rep for more information."
            ],
            [
                "q" => "Are Opuzen’s fabrics AB2998 compliant?",
                "a" => "While the majority of Opuzen’s fabrics are AB2998 compliant, some fabrics do require flame treatment if this is desired. Contact customer service for further Information."
            ],
            [
                "q" => "Are your vinyls graffiti free?",
                "a" => "Not every vinyl has a graffiti free finish, so please note that vinyls which are graffiti free note this in their specifications."
            ],
            [
                "q" => "What types of fabrics do you offer?",
                "a" => "Opuzen maintains an extensive selection of fabrics, something for every project! Contact your local ".link_reps("Showroom/Sales Rep for more information")."."
            ],
        ]
    ],
    [
        "categoryName" => "DIGITAL PRINTING",
        "categoryQuestions" => [
            [
                "q" => "What is the minimum order quantity for digital printing?",
                "a" => "The minimum order for hospitality orders is 3 yards and residential is 5 yards, unless your project is a Hospitality Model Room."
            ],
            [
                "q" => "What type of artwork files can be printed?",
                "a" => "Artwork files that you provide to create digital print fabrics should be original artwork or artwork files that you have the rights to use. Files should be high resolution at a minimum of 300 DPI, preferably in TIF or PSD format."
            ],
            [
                "q" => "What color references are acceptable?",
                "a" => "Fabric swatches, Pantones, Sherwin Williams or Benjamin Moore paint colors."
            ],
            [
                "q" => "What are the lead times for custom strike-off?",
                "a" => "Standard lead time is 2-3 weeks. For residential, strike-off fee payment is required before the lead time starts."
            ],
            [
                "q" => "What are the lead times for production?",
                "a" => "If the ground fabric is in stock and available, standard lead time is 4-6 weeks from receipt of deposit and/or CFA approval. Lead time can be expedited to 2-3 weeks with a 30% rush fee."
            ],
            [
                "q" => "What are match-to’s and why are they needed for digital orders?",
                "a" => "Since digital orders and samples are both made-to-order, we ask for match-to cuttings from client memo samples to ensure we are matching the colors correctly for production since colors may vary between prints."
            ],
        ]
    ],
    [
        "categoryName" => "QUOTES & ORDERS",
        "categoryQuestions" => [
            [
                "q" => "How do I obtain a quote?",
                "a" => "You can request a quote request by phone or contact customer service via email to <a class='oz-color' href='mailto:info@opuzen.com'>info@opuzen.com</a>. Please indicate a project name, quantity in yards, specifier or designer, and the intended fabric application."
            ],
            [
                "q" => "How long is a quote valid?",
                "a" => "A formal quote is valid for 15 days."
            ],
            [
                "q" => "How do I order fabric?",
                "a" => "Contact your local Opuzen ".link_reps("Showroom/Sales Rep for more information").". If you don’t see a Rep listed in your area, call us directly at ".link_tel("")."."
            ],
            [
                "q" => "Are there minimum order requirements?",
                "a" => "For Hospitality woven orders there is no minimum. For Residential woven orders, the minimum is 3 yards. For all Digitally-printed orders, there is a 3-yard minimum. All orders under 5 yards incur a $65 cut fee."
            ],
            [
                "q" => "How do I place an order?",
                "a" => "You can place an order by calling ".link_tel("").", or by email to <a class='oz-color' href='mailto:info@opuzen.com'>info@opuzen.com</a>. We might ask for a Purchase Order, or the equivalent info in an email, including a project name, specifier/ designer, ship-to and billing addresses, fabric application and any special side marks."
            ],
            [
                "q" => "What are my payment terms?",
                "a" => "Opuzen payment terms will be indicated on your invoice or sales order. Regular terms are pro forma, meaning we will require a full payment prior to shipping. For custom Digital printing, 50% payment is required to start production, and full payment is required prior to shipping."
            ],
            [
                "q" => "What payment methods do you accept?",
                "a" => "We accept ACH, checks, and wire transfers in USD. We also accept payment by credit card, please note that all credit card payments incur a 3% fee."
            ],
            [
                "q" => "Do you send cuttings for approval?",
                "a" => "Yes, we send physical or digital CFAs for Digital Prints. We send physical CFAs for woven orders over 50 yards or fabrics that are not consistent in their dye lots. Opuzen guarantees a commercial match."
            ],
            [
                "q" => "What is a freight-in surcharge?",
                "a" => "A freight-in surcharge is currently being applied to every order to cover increased freight costs at our Mills. The surcharge is an amount added to each yard ordered."
            ],
            [
                "q" => "How is a freight charge calculated?",
                "a" => "The freight charge is calculated by weight and dimensions of a package, destination, and insurance. A freight quote expires in 5 business days."
            ],
            [
                "q" => "Can I use my own freight account, a third-party freight account, or pick up my order?",
                "a" => "Absolutely. Please let us know when placing the order."
            ],
            [
                "q" => "Is there any fee for a third-party freight account or pick up?",
                "a" => "There are no Opuzen fees for handling freight yourself or through a third-party."
            ],
            [
                "q" => "How can I track the status of my order?",
                "a" => "Contact the Shipping Department or Customer Service."
            ],
            [
                "q" => "Does Opuzen deliver to locations outside the USA?",
                "a" => "Opuzen ships fabric worldwide! Additional Vat and duty fees may be applied to your order cost."
            ],
            [
                "q" => "What happens if I need to change or cancel my order?",
                "a" => "Call us at ".link_tel("")."."
            ],
            [
                "q" => "What is the returns policy?",
                "a" => "<ul><li>Returns are considered if requested within 14 days from receipt of order.</li><li>Goods must not be cut or altered in any way if a return is requested.</li><li>A 30 % Restocking fee will apply to returned orders.</li><li>Custom orders are non-cancellable/non-returnable.</li></ul>"
            ],
            [
                "q" => "How are taxes charged?",
                "a" => "Opuzen Design charges sales tax only if the end use of a fabric is within the state of California, unless a valid California Resale Certificate is provided."
            ],
            [
                "q" => "Are tariffs or duties added to my order?",
                "a" => "For international shipments duties, vat and other customs fees are the responsibility of a third party or the receiver."
            ],
            [
                "q" => "What is your policy on overages?",
                "a" => "<ul><li>Hospitality orders over 200 yards are subject to 5% overage.</li><li>Custom items are subject up to 10% overage.</li></ul>"
            ],
        ]
    ],

];
function format_qa_collapse($qa)
{
    $id = $qa['id'];
    $question = $qa['q'];
    $answer = $qa['a'];
    return "
		<p>
			<a class='faq-q oz-color btnSpec' data-toggle='collapse' href='#collapseAns$id' role='button' aria-expanded='false' aria-controls='collapseAns$id'>
				$question
			</a>
		</p>
		<div class='collapse' id='collapseAns$id'>
		  <div class='card card-body faq-a bkgr-black text-white' style='border:none; margin:0 0 20px 0;'>
				$answer
		  </div>
		</div>
		";
}

function format_qa($qa)
{
    $id = $qa['id'];
    $question = $qa['q'];
    $answer = $qa['a'];
    return "
            <p class='faq-q oz-color'>
                $question
            </p>
            <div class='faq-a bkgr-black text-white' style='border:none; margin:0 0 20px 0;'>
                $answer
            </div>
            ";
}

?>

<div style="margin: 22px 30px 0 41px;">
    <?php
    $i = 1;
    $categoryNames = array_column($faq, 'categoryName');
    echo "<div class='sections-subtitles-h2' style='color:white;'>Opuzen Frequently Asked Questions</div><br/>";
    foreach($categoryNames as $categoryName){
        $name = strtoupper($categoryName);
        echo "<a class='oz-color' href='#$name'>$name</a><br/>";
    }

    echo "<br/><hr style='background:white;' /><br/>";

    foreach($faq as $category){
        $name = strtoupper($category['categoryName']);
        echo "<p id='$name' class='faq-category-title oz-color'>".$name."</p>";
        foreach($category['categoryQuestions'] as &$qa){
            $qa['id'] = $i;
            echo format_qa($qa);
            $i++;
        }
        echo "<br/>";
    }
    ?>
</div>

<!--<div style="margin: 22px 30px 0 41px;">-->
<!--    <p class="faq-q oz-color btnSpec">What size are samples?</p>-->
<!--    <p class="faq-a bkgr-black text-white">The standard upholstery memo (sample) size is 12” x 12”, and a drapery/sheer memo size: 18” x 18”</p>-->
<!--</div>-->


<style>
    [id]::before {
        content: '';
        display: block;
        height:      175px;
        margin-top: -175px;
        visibility: hidden;
    }
    .faq-q {
        font-weight: normal !important;
        font-size: 13px;
    }

    .faq-q:hover {
        /*color: white!important;*/
    }

    .faq-a {
        font-size: 12px;
        line-height: 25px;
    }

    ul {
        padding-left: 13px;
    }

    a:hover {
        color: white!important;
    }
</style>
