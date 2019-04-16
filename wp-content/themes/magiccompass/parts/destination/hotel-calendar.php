<?php
/**
 * Hotel Calendar Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @version 0.0.8
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function showMonth($month, $year)
{
    $search = ittour_search('ru');

    $args = array(
        'from_city' => '2014',
        'hotel_rating' => '78',
        'hotel' => '2984',
        'adult_amount' => 2,
        'night_from' => 7,
        'night_till' => 9,
        'items_per_page' => 1,
        'prices_in_group' => 1,
        'currency' => 1,
    );

    $date = mktime(12, 0, 0, $month, 1, $year);
    $daysInMonth = date("t", $date);
    $offset = (date("w", $date)-1)%7;
    $rows = 1;
    ?>
    <h3><?php echo date("F Y", $date); ?></h3>

    <table class="table">
        <tr>
            <th><?php _e('Monday', 'snthwp'); ?></th>
            <th><?php _e('Tuesday', 'snthwp'); ?></th>
            <th><?php _e('Wednesday', 'snthwp'); ?></th>
            <th><?php _e('Thursday', 'snthwp'); ?></th>
            <th><?php _e('Friday', 'snthwp'); ?></th>
            <th><?php _e('Saturday', 'snthwp'); ?></th>
            <th><?php _e('Sunday', 'snthwp'); ?></th>
        </tr>
    <?php
    echo "\t";
    echo "\n\t<tr>";

    for($i = 1; $i <= $offset; $i++)
    {
        echo "<td></td>";
    }

    for($day = 1; $day <= $daysInMonth; $day++)
    {
        if( ($day + $offset - 1) % 7 == 0 && $day != 1)
        {
            echo "</tr>\n\t<tr>";
            $rows++;
        }

        if ($day == date("j")) {
            echo "<td  bgcolor='yellow'>" . $day . "</td>";
        } elseif ($day > date("j")) {
            $args['date_from'] = $day . '.04.19';
            $args['date_from'] = $day . '.04.19';
            $search_result = $search->get(338, $args);

            $offer_html = '';

            if (!empty($search_result['hotels'][0])) {
                $offers = $search_result['hotels'][0]['offers'];
                $first_offer = $offers[0];

                $offer_html = '<br>' . __('from', 'snthwp') . ' ' . $first_offer['prices'][2];
            }

            echo "<td>" . $day . $offer_html . "</td>";
        } else {
            echo "<td>" . $day . "</td>";
        }


    }

    while( ($day + $offset) <= $rows * 7)
    {
        echo "<td></td>";
        $day++;
    }

    echo "</tr>\n";
    ?>
    </table>
    <?php
}
?>

<?php
showMonth(4, 2019); // July 2005
?>
