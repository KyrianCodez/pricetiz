<?php require_once('./includes/navbar.php');?>

<main>
    <div class="pageContainer">
        <section>
            <div class="sectionInner row">
                <div class="col-md-6 pr-md-5">
                    <h2 class="title mb-4">Contact <span class="">Us.</span></h2>
                    <form action="" id="contactForm" class="contactForm">
                        <div class="formField">
                            <input id="contact_name" class="formFieldInput form-control" type="text" placeholder="your name" required>
                        </div>
                        <div class="formField">
                            <input id="contact_email" class="formFieldInput" type="text" placeholder="your email" required>
                        </div>
                        <div class="formField">
                            <input id="contact_company" class="formFieldInput" type="text" placeholder="your company">
                        </div>
                        <div class="formField">
                            <textarea id="contact_message" class="formFieldTextarea" type="text" placeholder="message" required></textarea>
                        </div>
                        <button type="submit" class="button button-full">Submit</button>
                        <div id="mail-status"></div>
                    </form>
                </div>
                <div class="col-md-6 pl-md-5">
                    <h2 class="title mb-4">Address</h2>
                    <div class="addressContainer">
                        <h3>TURRENE PHARMED CO MEDICAL SUPPLIES</h3>
                        <h4>WALPOLE, MA 02081</h4>
                        <h4>(781) 806-0264</h4>

                        <div style="width: 100%; box-shadow: 0px 3px 40px #C3CDD86A; margin-top: 20px;"><iframe width="100%" height="230" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=230&amp;hl=en&amp;q=WALPOLE,%20MA%2002081+(TURRENE%20PHARMED%20CO%20MEDICAL%20SUPPLIES)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

 <?php include_once('layouts/legacyfooter.php');?>