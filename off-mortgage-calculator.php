<?php
/*
Plugin Name: OFF Mortgage Calculator
Description: Calculates the monthly cost of a 30-year mortgage. You can use the [off_mortgage_calculator] shortcode.
Version: 1.0
Author: Line49
*/

add_shortcode( 'off_mortgage_calculator', 'off_calculator_function' );

// enqueue script file
add_action('wp_enqueue_scripts', 'off_mortgage_calculator_enqueue_scripts');
function off_mortgage_calculator_enqueue_scripts() {
    // Enqueue the JavaScript file
    wp_enqueue_script('off_mortgage_calculator_script', plugins_url('off-mortgage-calculator.js', __FILE__), array(), '1.0', true);

    // Enqueue the CSS file
    wp_enqueue_style('off_mortgage_calculator_styles', plugin_dir_url(__FILE__) . 'off-mortgage-calculator.css', array(), '1.0');
}

function off_calculator_function() { ?>

    <?php ob_start(); ?>

    <div class="off-mortgage-calculator">
        <h1>Mortgage Calculator</h1>
        <p>Estimate Your Monthly Mortgage Payment (Up to 30 Years)</p>
        <form>
            <div class="mortgage">
                <label><strong>Mortgage Amount ($):</strong></label>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="$CAD" required>
            </div>

            <div class="down-payment">
                <label><strong>Down Payment ($):</strong></label>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="$CAD" required>
            </div>

            <div class="interest">
                <label><strong>Interest Rate (%):</strong></label>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" placeholder="E.g. 3.5%" required>
            </div>

            <div class="loan-term">
                <label><strong>Select Length of Term:</strong></label>
                <select class="loanTerm" required>
                    <option value="15">15 years</option>
                    <option value="20" selected>20 years</option>
                    <option value="25">25 years</option>
                    <option value="30">30 years</option>
                </select>
            </div>

            <button type="button" class="off-mortgage-submit-button">Calculate</button>

            <div class="off-mortgage-estimate"></div>
        </form>

        <p class="disclaimer">Based on a fully amortized fixed rate loan. Ask your agent for the tax rates in your area. Insurance estimate is based on an average cost, your final premium cost will be determined by the type of coverage you select. This program only provides an estimate.</p>
    </div>

    <?php return ob_get_clean();

} ?>