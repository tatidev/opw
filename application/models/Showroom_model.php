<?
// test comment
class Showroom_model extends MY_Model
{

    protected $showrooms_data = [
        [
            'id' => 0,
            'name' => 'Allan Knight & Associates',
            'contact' => 'Brian Hackfeld',
            'address_street_1' => '150 Turtle Creek Blvd., Ste. 101',
            'address_street_2' => null,
            'address_city' => 'Dallas',
            'address_state' => 'TX',
            'address_zipcode' => '75207',
            'phone_1' => '214-741-2227',
            'phone_2' => null,
            'email' => 'bhackfeld@allan-knight.com',
            'website' => 'www.allan-knight.com',
            'territory_states_US' => 'Arkansas::::,Louisiana::::Hospitality & Residential,Oklahoma::::Hospitality & Residential,Texas::::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ],
        [
            'id' => 1,
            'name' => 'Ammon Hickson',
            'contact' => null,
            'address_street_1' => 'Design Center of The Americas',
            'address_street_2' => '1855 Griffin Road, Ste. B240',
            'address_city' => 'Dania Beach',
            'address_state' => 'FL',
            'address_zipcode' => '330004',
            'phone_1' => '954-925-1555',
            'phone_2' => null,
            'email' => 'info@ammonhickson.com',
            'website' => 'www.ammonhickson.com',
            'territory_states_US' => 'Florida::::Hospitality & Residential',
            'territory_INT' => 'Caribbean / Puerto Rico',
            'territory_display' => null,
            'territory_type' => null,
            'force_order' => 1
        ],
        [
            'id' => 2,
            'name' => 'Anthony Inc.',
            'contact' => null,
            'address_street_1' => '2041 W Grand Ave',
            'address_street_2' => null,
            'address_city' => 'Chicago',
            'address_state' => 'IL',
            'address_zipcode' => '60612',
            'phone_1' => '312-321-0847',
            'phone_2' => null,
            'email' => 'info@anthonyinc.net',
            'website' => 'www.anthonyinc.net',
            'territory_states_US' => 'Illinois::::Hospitality & Residential,Indiana::::Hospitality & Residential,Iowa::::Hospitality & Residential,Kansas::::Hospitality & Residential,Kentucky::::Hospitality & Residential,Michigan::::Hospitality & Residential,Minnesota::::Hospitality & Residential,Missouri::::Hospitality & Residential,Nebraska::::Hospitality & Residential,Ohio::::Hospitality & Residential,Wisconsin::::Hospitality & Residential',
            'territory_INT' => 'Canada / Toronto',
            'territory_display' => null,
            'territory_type' => null,
            'force_order' => 2
        ],
        [
            'id' => 3,
            'name' => 'A. Resource LA',
            'contact' => 'Anna Navarrete',
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_state' => null,
            'address_zipcode' => null,
            'phone_1' => '323-363-3839',
            'phone_2' => null,
            'email' => 'anna@aresource-la.com',
            'website' => 'www.aresource-la.com',
            'territory_states_US' => 'California::Los Angeles County::Hospitality',
            'territory_INT' => null,
            'territory_display' => 'Los Angeles',
            'territory_type' => 'Hospitality',
            'force_order' => 1
        ],
        [
            'id' => 4,
            'name' => 'Diane Cote',
            'contact' => null,
            'address_street_1' => '7522 E. McDonald Dr, Suite A',
            'address_street_2' => null,
            'address_city' => 'Scottsdale',
            'address_state' => 'AZ',
            'address_zipcode' => '85250',
            'phone_1' => '480-818-3252',
            'phone_2' => null,
            'email' => 'info@dianecote.net',
            'website' => 'www.dianecote.net',
            'territory_states_US' => 'Arizona::::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ],
//			[
//				'id' => 5,
//				'name' => 'Erik Waldorf',
//				'contact' => null,
//				'address_street_1' => '1008 Washington Pl E',
//				'address_street_2' => null,
//				'address_city' => 'Seattle',
//				'address_state' => 'WA',
//				'address_zipcode' => '98112',
//				'phone_1' => '650-504-0402',
//				'phone_2' => null,
//				'email' => 'erik@erikwaldorf.com',
//				'website' => 'www.erikwaldorf.com',
//				'territory_states_US' => 'Alaska::::,Oregon::::,Washington::::',
//				'territory_INT' => null,
//				'territory_display' => null,
//				'territory_type' => null
//			],
        [
            'id' => 5,
            'name' => 'Amber Hervey Studio',
            'contact' => null,
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_state' => null,
            'address_zipcode' => null,
            'phone_1' => '415-309-6154',
            'phone_2' => null,
            'email' => 'amber@amberherveystudio.com',
            'website' => 'www.amberherveystudio.com',
            'territory_states_US' => 'Oregon::::Hospitality & Residential,Washington::::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ],
        [
            'id' => 6,
            'name' => 'Etoile',
            'contact' => null,
            'address_street_1' => '31700 Lonesome Dove Ct',
            'address_street_2' => null,
            'address_city' => 'Elizabeth',
            'address_state' => 'CO',
            'address_zipcode' => '80107',
            'phone_1' => '303-618-2530',
            'phone_2' => null,
            'email' => 'ginny@etoiledecor.com',
            'website' => 'www.etoiledecor.com',
            'territory_states_US' => 'Colorado::::Hospitality & Residential,Idaho::::Hospitality & Residential,Montana::::Hospitality & Residential,New Mexico::::Hospitality & Residential,Utah::::Hospitality & Residential,Wyoming::::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ],
        /*[
            'id' => 7,
            'name' => 'Finborough Fabrics',
            'contact' => null,
            'address_street_1' => 'White Horse House',
            'address_street_2' => 'GT Finbourough',
            'address_city' => 'Suffolk',
            'address_state' => 'United Kingdom',
            'address_zipcode' => 'IPI43AE',
            'phone_1' => '+44 (0) 1449613807',
            'phone_2' => '+44 (0) 7719834537',
            'email' => null,
            'website' => null,
            'territory_states_US' => null,
            'territory_INT' => 'UK',
            'territory_display' => null,
            'territory_type' => null,
            'force_order' => 4
        ],*/
        [
            'id' => 8,
            'name' => 'Koroseal Interior Products, LLC',
            'contact' => 'Bibi Mohamed',
            'address_street_1' => 'D&D Building 979 Third Ave., #842',
            'address_street_2' => null,
            'address_city' => 'New York',
            'address_state' => 'NY',
            'address_zipcode' => '10022',
            'phone_1' => '212-751-1595',
            'phone_2' => null,
            'email' => 'bmohamed@koroseal.com',
            'website' => 'www.koroseal.com',
            'territory_states_US' => 'New York City::::Residential & Hospitality,New York State::::Hospitality,New Jersey::::Hospitality,Massachusetts::::Hospitality',
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ],
        [
            'id' => 9,
            'name' => 'MR Design Lab',
            'contact' => null,
            'address_street_1' => '5725 S Valley View Blvd, Suite 9',
            'address_street_2' => null,
            'address_city' => 'Las Vegas',
            'address_state' => 'NV',
            'address_zipcode' => '89118',
            'phone_1' => '702-202-4550',
            'phone_2' => null,
            'email' => 'info@mrdesignlab.com',
            'website' => 'www.mrdesignlab.com',
            'territory_states_US' => 'Nevada::::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => 'Las Vegas, Southern Nevada',
            'territory_type' => null
        ],
        [
            'id' => 10,
            'name' => 'Natalie Mize Collective',
            'contact' => null,
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_state' => null,
            'address_zipcode' => null,
            'phone_1' => '925-872-4377',
            'phone_2' => null,
            'email' => 'natalie@nataliemize.com',
            'website' => 'www.nataliemize.com',
            'territory_states_US' => 'California::Northern California::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => 'Northern California, <br>Northern Nevada',
            'territory_type' => null,
            'force_order' => 2
        ],
        [
            'id' => 11,
            'name' => 'Paul +',
            'contact' => null,
            'address_street_1' => '351 Peachtree Hills Ave., #121',
            'address_street_2' => null,
            'address_city' => 'Atlanta',
            'address_state' => 'GA',
            'address_zipcode' => '30305',
            'phone_1' => '404-261-1820',
            'phone_2' => null,
            'email' => 'info@paulplusatlanta.com',
            'website' => 'www.paulplusatlanta.com',
            'territory_states_US' => 'Alabama::::Hospitality & Residential,Georgia::::Hospitality & Residential,Mississippi::::Hospitality & Residential,North Carolina::::Hospitality & Residential,Tennessee::::Hospitality & Residential,South Carolina::::Hospitality & Residential',
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ],
//        [
//            'id' => 12,
//            'name' => 'Theo Decor',
//            'contact' => null,
//            'address_street_1' => '722 Genevieve St., Suite F',
//            'address_street_2' => null,
//            'address_city' => 'Solana Beach',
//            'address_state' => 'CA',
//            'address_zipcode' => '92075',
//            'phone_1' => '858-259-0818',
//            'phone_2' => null,
//            'email' => 'sandiego@theodecor.com',
//            'website' => 'www.theodecor.com',
//            'territory_states_US' => 'California,Hawaii',
//            'territory_INT' => null,
//            'territory_display' => 'Southern California, <br>San Diego, Orange <br>County, Riverside County, <br>Palm Springs & surrounding <br>desert communities, Hawaii',
//            'territory_type' => null,
//            'force_order' => 3
//        ],
        [
            'id' => 12,
            'name' => 'AM Design Collaboration',
            'contact' => 'Allison Miller',
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_state' => null,
            'address_zipcode' => null,
            'phone_1' => '858-382-4847',
            'phone_2' => null,
            'email' => 'allison@amdesigncollaboration.com',
            'website' => 'www.amdesigncollaboration.com',
            'territory_states_US' => 'California::Orange County + San Diego::Hospitality & Residential,Hawaii::::',
            'territory_INT' => null,
            'territory_display' => 'Southern California, <br>San Diego, Orange County,<br>Riverside County, Palm Springs &<br> surrounding desert communities,<br>Hawaii',
            'territory_type' => null,
            'force_order' => 3
        ],
        [
            'id' => 13,
            'name' => 'Thomas Lavin',
            'contact' => null,
            'address_street_1' => 'Pacific Design Center',
            'address_street_2' => '8687 Melrose Ave., Suite B-310',
            'address_city' => 'West Hollywood',
            'address_state' => 'CA',
            'address_zipcode' => '90069',
            'phone_1' => '310-278-2456',
            'phone_2' => null,
            'email' => 'Info@thomaslavin.com',
            'website' => 'www.thomaslavin.com',
            'territory_states_US' => 'California::Los Angeles County::Residential',
            'territory_INT' => null,
            'territory_display' => 'Los Angeles, <br>San Bernardino County',
            'territory_type' => 'Residential',
            'force_order' => 4
        ],
        [
            'id' => 14,
            'name' => 'Altfield Enterprises',
            'contact' => null,
            'address_street_1' => '1101, 11/F, Nine Queen',
            'address_street_2' => null,
            'address_city' => 'Central',
            'address_state' => 'Hong Kong',
            'address_zipcode' => null,
            'phone_1' => '852-25244867',
            'phone_2' => null,
            'email' => null,
            'website' => 'www.altfield.com.hk',
            'territory_states_US' => null,
            'territory_INT' => "Hong Kong",
            'territory_display' => null,
            'territory_type' => null,
            'force_order' => 3
        ],
        [
            'id' => 15,
            'name' => 'O&apos;Hara Studio',
            'contact' => 'Cynthia O&apos;Hara',
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_state' => null,
            'address_zipcode' => null,
            'phone_1' => '917-836-9044',
            'phone_2' => null,
            'email' => "cynthia@oharastudio.com",
            'website' => "www.oharastudio.com",
            'territory_states_US' => "Connecticut::::Hospitality & Residential,Massachusetts::::Residential,New York State::::Residential,New Jersey::::Residential,Pennsylvania::::Residential",
            'territory_INT' => "Hong Kong",
            'territory_display' => null,
            'territory_type' => null,
            'force_order' => 3
        ],
        [
            'id' => 0,
            'name' => 'F2 Resourcing Collab',
            'contact' => 'Ashley Fabri',
            'address_street_1' => null,
            'address_street_2' => null,
            'address_city' => null,
            'address_state' => null,
            'address_zipcode' => null,
            'phone_1' => '410-490-7378',
            'phone_2' => null,
            'email' =>  'afabri@f2resourcingcollaborative.com &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; office@f2resourcingcollaborative.com',
            'website' => 'www.f2resourcingcollaborative.com',
            'territory_states_US' => "Maryland:: ::Hospitality & Residential,Pennsylvania::::Hospitality,Virginia:: ::Hospitality & Residential,Washington_DC:: ::Hospitality & Residential",
            'territory_INT' => null,
            'territory_display' => null,
            'territory_type' => null
        ]
    ];

    function __construct()
    {
        parent::__construct();
    }

    function get_showrooms_data()
    {
        return $this->showrooms_data;
    }

    function get_showrooms_us()
    {
        $ret = array_values(array_filter($this->showrooms_data, function ($element) {
            if (!is_null($element['territory_states_US'])) {
                return true;
            }
            return false;
        }));
        usort($ret, function ($item1, $item2) {
            $sort_key = 'name';
            if (array_key_exists('force_order', $item1) & array_key_exists('force_order', $item2)) {
                $sort_key = 'force_order';
            }
            if ($item1[$sort_key] == $item2[$sort_key]) return 0;
//				return $item1[$sort_key] < $item2[$sort_key] ? 1 : -1; # descending
            return $item1[$sort_key] < $item2[$sort_key] ? -1 : 1; # ascending
        });
        return $ret;
//			return array_values($ret);
    }

    function get_showrooms_international()
    {
        $ret = array_filter($this->showrooms_data, function ($element) {
            if (!is_null($element['territory_INT'])) {
                return true;
            }
            return false;
        });
        usort($ret, function ($item1, $item2) {
            $sort_key = 'territory_INT';
            if (array_key_exists('force_order', $item1) & array_key_exists('force_order', $item2)) {
                $sort_key = 'force_order';
            }
            if ($item1[$sort_key] == $item2[$sort_key]) return 0;
            return $item1[$sort_key] < $item2[$sort_key] ? -1 : 1; # ascending
        });
        return array_values($ret);
    }

    function get_showroom_states()
    {
        $states = array_filter(array_unique(explode(',', implode(',', array_column($this->showrooms_data, 'territory_states_US')))));
        sort($states);
        return $states;
    }

}