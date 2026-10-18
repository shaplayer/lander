<?php
$status = $_GET['signup'] ?? '';

function signup_form(string $id): void
{
    ?>
    <form class="signup" method="post" action="subscribe.php" id="<?= $id ?>">
        <p class="signup-kicker">Free BigStocks alerts</p>
        <h3>Get the next COSM update first</h3>
        <p class="signup-sub">Stock news by email, plus optional text alerts when a story moves.</p>
        <label>
            <span>Email</span>
            <input type="email" name="email" required autocomplete="email" placeholder="you@example.com">
        </label>
        <label>
            <span>Mobile number <em>(optional, for text alerts)</em></span>
            <input type="tel" name="phone" autocomplete="tel" placeholder="(555) 555-5555">
        </label>
        <label class="consent">
            <input type="checkbox" name="sms_consent" value="1">
            <span>Text me stock alerts. By checking this box, I agree to receive recurring automated marketing text messages from BigStocks at the number provided. Consent is not a condition of purchase. Msg frequency varies. Msg &amp; data rates may apply. Reply STOP to cancel, HELP for help.</span>
        </label>
        <input type="text" name="website" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
        <input type="hidden" name="source" value="cosm-subscriptions">
        <button type="submit">Get Free Alerts</button>
        <p class="fine">Free. Unsubscribe anytime.</p>
    </form>
    <?php
}

function signup_status(string $status): void
{
    if ($status === 'ok') {
        echo '<div class="notice ok" role="status">You\'re in. Watch your inbox for the next BigStocks update.</div>';
    } elseif ($status === 'invalid') {
        echo '<div class="notice err" role="alert">Please enter a valid email. To get texts, add your mobile number and check the consent box.</div>';
    } elseif ($status === 'error') {
        echo '<div class="notice err" role="alert">Something went wrong on our end. Please try again in a minute.</div>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>6,287 Active Subscriptions Put COSM's U.S. Sales Surge in Focus | BigStocks News</title>
<meta name="description" content="Cosmos Health (NASDAQ: COSM) reported 6,287 active U.S. subscriptions and online sales above $60,000 a day. Here's what the numbers show, and what they don't.">
<meta property="og:title" content="6,287 Active Subscriptions Put COSM's U.S. Sales Surge in Focus">
<meta property="og:description" content="Recent U.S. online sales averaged more than $60,000 a day. Now the question is how many subscribers keep coming back.">
<meta property="og:image" content="assets/noor-marine-collagen.jpg">
<meta property="og:type" content="article">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="masthead">
    <div class="wrap masthead-inner">
        <span class="logo">BIG<span>STOCKS</span> <small>NEWS</small></span>
        <a class="masthead-cta" href="#signup-top">Free Alerts</a>
    </div>
</header>

<section class="hero">
    <div class="wrap">
        <p class="meta"><span class="ticker">NASDAQ: COSM</span> October 16, 2026</p>
        <h1>6,287 Active Subscriptions Put COSM's U.S. Sales Surge in Focus</h1>
        <p class="dek">Nearly all were added since mid-September. Recent U.S. online sales averaged more than $60,000 a day. Now the question is how many subscribers keep coming back.</p>
        <ul class="stats">
            <li><strong>6,287</strong><span>active U.S. subscriptions</span></li>
            <li><strong>$60K+</strong><span>daily online sales, last 10 days</span></li>
            <li><strong>$54.3M</strong><span>9-month revenue, up 19%</span></li>
        </ul>
    </div>
</section>

<div class="wrap layout">
    <article class="story">
        <figure>
            <img src="assets/noor-marine-collagen.jpg" width="530" height="530" alt="NOOR Marine Collagen Tripeptides supplement jar on a stone pedestal">
            <figcaption>NOOR Marine Collagen is one of Cosmos Health's U.S. consumer brands. Image: NOOR / Cosmos Health.</figcaption>
        </figure>

        <aside class="takeaways">
            <h2>Key Takeaways</h2>
            <ul>
                <li>Cosmos reported preliminary revenue of $54.3 million for the first nine months of 2026, up 19% from a year earlier.</li>
                <li>U.S. online sales totaled $902,000 over 30 days, and active subscriptions reached 6,287 by October 14.</li>
                <li>Cana Laboratories reported a manufacturing pipeline of more than 32.7 million units. Pipeline estimates are not completed sales or recognized revenue.</li>
                <li>The company still has to address an $8.9 million first-half loss, cash used in operations, and a going-concern warning in its June filing.</li>
            </ul>
        </aside>

        <div class="inline-signup" id="signup-top">
            <?php signup_status($status); ?>
            <?php signup_form('signup-inline'); ?>
        </div>

        <h2>A Bigger Story Than One Product</h2>
        <p>Cosmos Health has several businesses moving at once. Its Greek and U.K. operations distribute pharmaceuticals. Cana Laboratories manufactures healthcare products. And in the U.S., brands such as NOOR, 18 Series, and the company's skincare line are being sold directly to consumers online.</p>
        <p>That mix matters. The recent headlines have focused on fast-growing online sales and NOOR collagen, but the shareholder letter describes a broader company. For the first nine months of 2026, Cosmos reported preliminary revenue of $54.3 million, 19% above the same period last year. Preliminary third-quarter revenue was about $17.4 million, a record for that quarter.</p>
        <blockquote>Those figures suggest the business is expanding. They are also preliminary and unaudited, and they do not mean Cosmos is profitable. That distinction runs through the whole story.</blockquote>

        <h2>The U.S. Sales Numbers Have Real Momentum</h2>
        <p>Cosmos says its U.S. direct-to-consumer business generated $902,000 in sales during a 30-day period covered by its October 13 update. Daily sales averaged about $30,000 across that period, then topped $60,000 a day over the latest 10 days. On October 11, sales passed $92,000 for a single-day record.</p>
        <p>Subscriptions are the other number to watch. Cosmos reported 6,287 active U.S. subscriptions as of October 14, with most added since mid-September. Of the online checkout orders tracked by its subscription platform, 60.5% included a subscription; in recent days, the share was above 75%.</p>
        <p>At standard renewal prices, the active subscriptions represented about $920,000 in monthly value. That is a useful sign of early customer interest, but it is not revenue already earned. Customers can cancel, pause, or skip orders, so retention will determine how much of that value becomes actual sales.</p>
        <p>NOOR collagen helped launch the subscription program, but Cosmos has not reported collagen-only sales. The $902,000 includes NOOR, other 18 Series supplements, and skincare. In other words, the update shows the online channel is growing; it does not tell us which product is doing the most selling.</p>

        <h2>The Manufacturing Pipeline Could Add Another Engine</h2>
        <p>Cana Laboratories, Cosmos's manufacturing subsidiary, reported a pipeline exceeding 32.7 million units. The company estimates that the contracts could represent more than $20 million in revenue over their remaining terms.</p>
        <p>That is a large pipeline, but it is still work ahead. Customers need to place orders, Cana needs to produce and deliver the units, and Cosmos needs to collect payment. The pipeline could support future growth if those steps happen; it should not be counted as revenue today.</p>
        <p>Cosmos also has an established distribution operation. It said its Greek subsidiary CosmoFarm generated more than $15 million in second-quarter revenue and served about 360 pharmacies each day, within a broader network of more than 1,500. The company says its brands are sold in more than 40 countries.</p>

        <h2>Here's the Part Investors Shouldn't Skip</h2>
        <p>Cosmos reported a net loss of about $8.9 million for the first half of 2026 and used about $2.8 million in cash for operating activities. Its June 30 filing disclosed substantial doubt about its ability to continue as a going concern, reflecting its history of losses and need for cash and financing.</p>
        <p>Management expects 2026 revenue to exceed $90 million. Here is the scale of the task: after reporting $54.3 million for the first nine months, Cosmos would need at least about $35.7 million in the fourth quarter to reach $90 million. That is more than twice its preliminary third-quarter revenue of $17.4 million. This is a simple comparison of the company's figures, not a prediction, but it shows why execution matters.</p>

        <h2>What Could Change the Story</h2>
        <p>COSM's opportunity is that several parts of the business are growing at the same time: distribution, manufacturing, and the U.S. consumer channel. If the company can turn subscriptions into repeat purchases, convert manufacturing agreements into delivered orders, and improve cash generation, those businesses could become more valuable contributors.</p>
        <p>The proof will come in the next results: whether customers stay, whether pipeline work turns into reported revenue, and whether revenue growth starts to narrow losses and support cash flow. For investors, Cosmos has a bigger growth story than a collagen launch, but the company still has to show that growth can pay its bills.</p>

        <div class="end-signup">
            <?php signup_form('signup-bottom'); ?>
        </div>

        <section class="sources">
            <h2>Sources</h2>
            <p>Cosmos Health CEO Greg Siokas shareholder letter and company release; U.S. direct-to-consumer update (October 13, 2026); subscription update (October 14, 2026); preliminary revenue update (October 7, 2026); Cana Laboratories pipeline update (September 28, 2026).</p>
        </section>
    </article>

    <aside class="rail">
        <div class="sticky">
            <?php signup_form('signup-rail'); ?>
        </div>
    </aside>
</div>

<footer class="footer">
    <div class="wrap">
        <span class="logo">BIG<span>STOCKS</span> <small>NEWS</small></span>
        <p>This is stock news and analysis, not personalized investment advice. Revenue figures are preliminary where stated. Subscription value and manufacturing pipeline estimates are not guaranteed revenue. Small-cap stocks can be highly volatile, and investors may lose some or all of their investment.</p>
        <p>&copy; 2026 BigStocks News</p>
    </div>
</footer>

</body>
</html>
