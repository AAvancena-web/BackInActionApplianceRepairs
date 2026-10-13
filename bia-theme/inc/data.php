<?php
/**
 * Site copy and structured content.
 *
 * Everything a client might want to reword lives here. Contact details
 * (phone, email, service area) are set in Customizer > Back In Action Settings.
 *
 * @package BIA
 */

defined( 'ABSPATH' ) || exit;

/**
 * The three services. Keys are page slugs.
 */
function bia_services() {
	return array(
		'washing-machine-repairs' => array(
			'title'     => 'Washing Machine Repairs',
			'short'     => 'Washing Machines',
			'single'    => 'washing machine',
			'icon'      => 'washer',
			'card'      => 'Front loaders and top loaders that will not spin, drain, fill or start. Fixed in your laundry, usually on the first visit.',
			'hero_lead' => 'Washer stopped mid cycle, leaking across the laundry floor or throwing an error code? We come to you anywhere in Melbourne, find the fault fast and get your washing machine back in action.',
			'intro_title' => 'Front loader or top loader, we will get it spinning again',
			'intro'     => array(
				'A broken washing machine stops the whole house. Towels pile up, school uniforms run out and the laundromat is not an option for long. We keep the common parts in the van, so most washing machine repairs are done on the spot in a single visit.',
				'Every job starts with a proper diagnosis. We test the motor, pump, inlet valves, door lock, bearings and control board, explain what has failed in plain English and give you a fixed price before any work begins. If a repair is not worth it, we will tell you straight.',
			),
			'faults'    => array(
				array( 'Not draining', 'Blocked or failed drain pumps, kinked hoses and filters packed with lint and coins.' ),
				array( 'Not spinning', 'Worn motor brushes, failed drive belts, faulty speed sensors and out of balance loads.' ),
				array( 'Leaking water', 'Split door seals, loose hoses, cracked tubs and worn pump seals.' ),
				array( 'Loud banging or grinding', 'Worn drum bearings, broken suspension springs and failed shock absorbers.' ),
				array( 'Door will not open or lock', 'Faulty door interlocks, broken handles and water level sensor faults.' ),
				array( 'Not filling or not starting', 'Failed inlet valves, blown fuses, control board faults and error codes.' ),
			),
			'included'  => array(
				'Full diagnostic test of the machine',
				'Fixed price quote before any work starts',
				'Common parts carried in the van',
				'Genuine or quality equivalent parts',
				'Test run on a full cycle before we leave',
				'Workmanship guarantee on every repair',
			),
			'repair_or_replace' => 'As a guide, a washing machine under ten years old with a single failed part is almost always worth repairing. Pumps, belts, door locks, inlet valves and seals are quick, affordable fixes. Worn bearings and control boards cost more, so we will give you the numbers and an honest opinion before you decide.',
			'faqs'      => array(
				array( 'Do you repair both front loaders and top loaders?', 'Yes. We repair front loading and top loading washing machines, including combination washer dryers, across all the major brands sold in Australia.' ),
				array( 'My washer is showing an error code. Can you fix it?', 'Error codes point us in the right direction, but they do not always name the failed part. Tell us the code when you book and we will bring the most likely parts so the repair can be finished on the first visit.' ),
				array( 'Should I keep using the machine if it is leaking?', 'No. Turn it off at the wall and turn off the taps behind the machine. Water around electrical parts is a safety risk and can damage your floor.' ),
				array( 'How long does a washing machine repair take?', 'Most repairs take between 30 and 90 minutes once we are on site. If a part needs to be ordered in, we will book the return visit with you before we leave.' ),
			),
		),
		'dryer-repairs'           => array(
			'title'     => 'Dryer Repairs',
			'short'     => 'Dryers',
			'single'    => 'dryer',
			'icon'      => 'dryer',
			'card'      => 'Vented, condenser and heat pump dryers that will not heat, tumble or turn on. Diagnosed and repaired at your home.',
			'hero_lead' => 'Clothes still damp after a full cycle, drum not turning or a burning smell from the laundry? We repair vented, condenser and heat pump dryers across Melbourne and get them drying properly again.',
			'intro_title' => 'Warm, dry clothes again, without the wait',
			'intro'     => array(
				'When a dryer stops heating or tumbling, the clothes horse comes out and the house fills up with damp washing. We diagnose the fault in your laundry and carry the parts that fail most often, including heating elements, thermal fuses, belts and rollers.',
				'Dryers also deserve a little care. A blocked lint path makes a dryer work harder and is a common cause of overheating. While we are there we will check the airflow and let you know if anything needs attention, so your repair lasts.',
			),
			'faults'    => array(
				array( 'Not heating', 'Failed heating elements, blown thermal fuses, faulty thermostats and heat pump faults.' ),
				array( 'Drum not turning', 'Snapped drive belts, worn idler pulleys and failed motors.' ),
				array( 'Taking too long to dry', 'Blocked lint filters and ducting, failed sensors and full condenser units.' ),
				array( 'Squealing or thumping', 'Worn drum rollers, bearings and glides.' ),
				array( 'Not turning on', 'Door switches, start switches, timers and control board faults.' ),
				array( 'Overheating or burning smell', 'Lint build up, failed cycling thermostats and airflow problems. Stop using it and call us.' ),
			),
			'included'  => array(
				'Full diagnostic test of the dryer',
				'Fixed price quote before any work starts',
				'Airflow and lint path check',
				'Genuine or quality equivalent parts',
				'Heat and tumble test before we leave',
				'Workmanship guarantee on every repair',
			),
			'repair_or_replace' => 'Most dryer faults are simple and affordable to fix. Belts, elements, thermal fuses and rollers are everyday repairs. Heat pump dryers cost more to replace, so a repair is usually the smart choice. We will always give you a fixed price first so you can decide with confidence.',
			'faqs'      => array(
				array( 'Do you repair heat pump dryers?', 'Yes. We repair vented, condenser and heat pump dryers, including the sealed heat pump units found in most newer models.' ),
				array( 'My dryer smells like it is burning. What should I do?', 'Stop the dryer, unplug it and let it cool. A burning smell usually means lint has built up near the heater or a part is failing. Do not use it again until it has been checked.' ),
				array( 'Why does my dryer take two cycles to dry clothes?', 'The most common causes are a blocked lint filter or duct, a full or blocked condenser, or a failed heating element or sensor. We can find which one it is on the first visit.' ),
				array( 'Can you repair a stacked dryer?', 'Yes. Wall mounted and stacked dryers are no problem. Just let us know when you book so we bring the right equipment.' ),
			),
		),
		'dishwasher-repairs'      => array(
			'title'     => 'Dishwasher Repairs',
			'short'     => 'Dishwashers',
			'single'    => 'dishwasher',
			'icon'      => 'dishwasher',
			'card'      => 'Freestanding, built in and integrated dishwashers that will not drain, clean, dry or start. Sorted in your kitchen.',
			'hero_lead' => 'Water sitting in the bottom, dishes coming out dirty or a dishwasher that simply will not start? We repair freestanding and integrated dishwashers across Melbourne so you can stop washing up by hand.',
			'intro_title' => 'Clean dishes again, without the sink full of washing up',
			'intro'     => array(
				'A dishwasher that will not drain or clean is one of the most common calls we get. In many cases the fix is a blocked filter, pump or spray arm. Other times it is a failed drain pump, heater or control fault. We find the cause, not just the symptom.',
				'We work carefully in your kitchen, protect your floors and cabinetry, and test the dishwasher on a full cycle before we leave. Built in and integrated models are no problem.',
			),
			'faults'    => array(
				array( 'Not draining', 'Blocked filters and sumps, failed drain pumps and kinked or blocked drain hoses.' ),
				array( 'Dishes not clean', 'Blocked spray arms, failed wash pumps, faulty diverters and detergent dispenser faults.' ),
				array( 'Not drying', 'Failed heating elements, faulty sensors and empty or broken rinse aid dispensers.' ),
				array( 'Leaking', 'Worn door seals, cracked hoses, failed pumps and overfill faults.' ),
				array( 'Not filling with water', 'Failed inlet valves, float switch faults and blocked inlet screens.' ),
				array( 'Not starting or error codes', 'Door latches, control boards, touch panels and flood protection faults.' ),
			),
			'included'  => array(
				'Full diagnostic test of the dishwasher',
				'Fixed price quote before any work starts',
				'Filter, sump and spray arm clean',
				'Genuine or quality equivalent parts',
				'Full wash cycle test before we leave',
				'Workmanship guarantee on every repair',
			),
			'repair_or_replace' => 'Integrated and premium dishwashers are well worth repairing, and most common faults like pumps, inlet valves, door seals and latches are affordable fixes. Replacing a built in dishwasher can also mean new panels and cabinetry work. We will give you a fixed price first so you can make the right call.',
			'faqs'      => array(
				array( 'There is water sitting in the bottom of my dishwasher. Is it broken?', 'Not always. A blocked filter is the most common cause, and you can check that yourself. If the filter is clean and the water is still there, the drain pump or hose likely needs attention.' ),
				array( 'Do you repair integrated and built in dishwashers?', 'Yes. We repair freestanding, built under, semi integrated and fully integrated dishwashers, and we take care with your cabinetry.' ),
				array( 'Why are my dishes still dirty after a cycle?', 'Common causes are blocked spray arms or filters, a failing wash pump, low water fill or the wrong detergent. We check all of these as part of the diagnosis.' ),
				array( 'Is it safe to run the dishwasher if it is leaking?', 'We recommend you stop using it until it has been checked. Leaks can damage kitchen floors and cabinetry quickly.' ),
			),
		),
	);
}

/**
 * Get one service by slug.
 *
 * @param string $slug Service slug.
 * @return array|null
 */
function bia_get_service( $slug ) {
	$services = bia_services();
	return isset( $services[ $slug ] ) ? $services[ $slug ] : null;
}

/**
 * Brands we service (plain text, no logos).
 */
function bia_brands() {
	return array( 'Bosch', 'Miele', 'LG', 'Samsung', 'Fisher & Paykel', 'Electrolux', 'Westinghouse', 'Simpson', 'Haier', 'Asko', 'Smeg', 'Whirlpool', 'AEG', 'Beko', 'Hisense', 'Midea', 'Siemens', 'Dishlex', 'Chef', 'Euromaid' );
}

/**
 * Trust points (homepage strip and service pages).
 */
function bia_trust_points() {
	return array(
		array( 'icon' => 'tag', 'title' => 'Upfront pricing', 'text' => 'A fixed quote before any work starts. No surprises.' ),
		array( 'icon' => 'bolt', 'title' => 'Fast bookings', 'text' => 'Same day and next day appointments where available.' ),
		array( 'icon' => 'van', 'title' => 'We come to you', 'text' => 'Repairs done in your home, with common parts in the van.' ),
		array( 'icon' => 'shield', 'title' => 'Workmanship guaranteed', 'text' => 'Every repair is backed by our workmanship guarantee.' ),
	);
}

/**
 * Why choose us (homepage and about).
 */
function bia_reasons() {
	return array(
		array( 'icon' => 'target', 'title' => 'Three appliances, done properly', 'text' => 'We focus on washing machines, dryers and dishwashers. Doing fewer things means we know them inside out and carry the right parts.' ),
		array( 'icon' => 'family', 'title' => 'Raised in the trade', 'text' => 'Back In Action grew out of a family that has been fixing household appliances for years. The know how is passed down. The business is new and hungry.' ),
		array( 'icon' => 'chat', 'title' => 'Straight answers', 'text' => 'We explain the fault in plain English. If a repair is not worth your money, we will say so.' ),
		array( 'icon' => 'clock', 'title' => 'On time, every time', 'text' => 'We give you a booking window and we stick to it. If anything changes, you hear from us first.' ),
		array( 'icon' => 'home', 'title' => 'Respect for your home', 'text' => 'Shoe covers on, floors protected, and the laundry or kitchen left as clean as we found it.' ),
		array( 'icon' => 'leaf', 'title' => 'Repair before replace', 'text' => 'Fixing a good appliance saves you money and keeps another machine out of landfill.' ),
	);
}

/**
 * How it works.
 */
function bia_process() {
	return array(
		array( 'title' => 'Call or book online', 'text' => 'Tell us the appliance, the brand and what it is doing. We will lock in a time that suits you.' ),
		array( 'title' => 'We diagnose the fault', 'text' => 'Your technician arrives on time, tests the appliance and finds the real cause.' ),
		array( 'title' => 'You approve the price', 'text' => 'You get a fixed price before any work begins. No obligation, no pressure.' ),
		array( 'title' => 'Back in action', 'text' => 'We repair it on the spot where possible, test it on a full cycle and clean up.' ),
	);
}

/**
 * Areas served. Edit to suit the real service area.
 */
function bia_areas() {
	return array(
		'Melbourne CBD and inner suburbs',
		'Northern suburbs',
		'Western suburbs',
		'Eastern suburbs',
		'South eastern suburbs',
		'Bayside',
		'Inner north',
		'Inner south',
	);
}

/**
 * General FAQs (homepage).
 */
function bia_faqs() {
	return array(
		array( 'Which appliances do you repair?', 'We specialise in washing machines, clothes dryers and dishwashers. Focusing on these three means we carry the right parts and get most jobs done on the first visit.' ),
		array( 'Which areas do you cover?', 'We cover the Melbourne metro area. Call us with your suburb and we will confirm your booking window.' ),
		array( 'How much does a repair cost?', 'Every appliance and fault is different, so we diagnose first and then give you a fixed price before any work starts. You only go ahead if you are happy with the quote.' ),
		array( 'Can you come today?', 'We offer same day and next day appointments where available. Call early in the day for the best chance of a same day visit.' ),
		array( 'Which brands do you repair?', 'We repair all the major brands sold in Australia, including Bosch, Miele, LG, Samsung, Fisher & Paykel, Electrolux, Westinghouse, Simpson and Haier.' ),
		array( 'Do you guarantee your work?', 'Yes. Every repair is covered by our workmanship guarantee. If the same fault comes back, so do we.' ),
	);
}

/**
 * Customer reviews. Leave empty to hide the reviews section.
 * Add real reviews only, for example from Google:
 * array( 'name' => 'Sam, Brunswick', 'text' => 'Review text', 'service' => 'Washing machine repair' ),
 */
function bia_reviews() {
	return apply_filters( 'bia_reviews', array() );
}
