<?php
/*
Template Name: Hardcoded Circles Page
Template Post Type: page, post, program-page
*/
get_header();
global $assets_uri, $upload_uri;
?>
<section>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            ?>
    <article class="inner-page">
        <div class="container">
            <div class="row">

                <div class="col-sm-24">
                    <?php get_breadcrumb(); ?>
                </div>
                <div class="col-sm-17" style="background-color:white;border-radius:25px">
                    <img src="<?php echo esc_url($upload_uri); ?>/2020/09/mit_circles_logo_wordmark_full_size.png"
                         style="display:block;text-align:center;width:60%;margin:1rem auto">
                </div>
                <div class="col-sm-17">
                    <br>
                    <h1>MIT Circles</h1>

                    <a href="https://forms.gle/SoZUBRmAYCh3yGiA7">
                        Please fill out this 5-minute form
                    </a>
                    by Tuesday, September 29th if you're interested in joining an MIT Circle.

                    <h2>Invitation to Apply</h2>
                    <b>
                        Dear MITCNC members:
                    </b>
                    <p>
                        Our lives are filled with challenges, dilemmas, stresses, and hard-won lessons.
                        If you would like to have a group of trusted MIT Alums to serve as a personal board of directors
                        or brain trust, read on.
                    <p>
                        MIT Circles are groups of 7-10 NorCal MIT Alums in similar career or life stages who meet
                        regularly to help one another grow professionally and personally. Participants will have the
                        opportunity to:
                    <ul>
                        <li>Reflect on questions and ideas with a smart and thoughtful group of fellow MIT alums&mdash;outside
                            of existing social and professional circles
                        <li>Get unbiased advice on difficult topics from a group focused on providing mutual support
                        <li>Form long-lasting connections with a trusted and respected group of peers
                    </ul>
                    <p>
                        This initiative requires participants to commit to 1-hour, virtual meetups every two weeks
                        over a six-month period (meetup schedules TBD based on participants’ availabilities).
                    </p><br>
                    Interested in joining a Circle?
                    <a href="https://forms.gle/SoZUBRmAYCh3yGiA7">
                        Please fill out this 5-minute form
                    </a>
                    by Tuesday, September 29th.
                    <p>
                        You may also be interested in this
                        invitation as an event,
                        available <a href="/events/mit-circles/">
                            on our events pages
                        </a>

                        <a name="FAQ">&nbsp;&nbsp;<br> </a>
                        <br><br><br>
                    <h2 style="margin-top:0">Frequently Asked Questions</h2>
                    <span style="font-weight:bold;color:black">
                            Jump to a section of the FAQ:
                        </span>
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/programs/mitcnc-circles#members">
                        Members
                    </a><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/programs/mitcnc-circles#meetings">
                        Meetings
                    </a><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/programs/mitcnc-circles#requirements">
                        Requirements
                    </a><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/programs/mitcnc-circles#misc">
                        Misc
                    </a><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/programs/mitcnc-circles#leads">
                        for Prospective Leads
                    </a><br><br>

                    <span style="font-weight:bold;color:black">What is MIT Circles?</span>
                    <ul>
                        <li>MIT Circles aims to help us navigate our careers, professional growth, and personal lives by
                            sharing and receiving advice and perspectives from our very own personal board of directors
                            composed of trusted like-minded peer-friends. Some of the organizers have been / are
                            involved in similar groups and have found it to be rewarding and valuable so we want to
                            offer a similar experience to the MIT alumni audience.

                        </li>

                        <li>MIT Circles is based on concepts like <a href="https://hbr.org/2011/09/true-north-groups">True
                                North Groups</a> and <a href="https://www.ypo.org/">YPO</a>. Bill George, former CEO of
                            Medtronic who grew the company from $1B to $60B and pioneered the concept of <a
                                    href="https://hbr.org/2011/09/true-north-groups">True North Groups</a>, has said
                            that his True North Group has helped him to &ldquo;become more self-aware and open [and]
                            take risks with significant challenges.&rdquo;
                        </li>
                        <li>Many successful individuals have found participation in similar groups to be some of the
                            most impactful and rewarding experiences of their lives.
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">Why should I join?</span>
                    <p>MIT Circles will provide you with the opportunity to:</p>
                    <ul>
                        <li>Reflect on questions and ideas with a smart and thoughtful group of fellow MIT alums -
                            outside of existing social circles
                        </li>
                        <li>Get unbiased advice on difficult topics from a group focused on providing mutual support
                        </li>
                        <li>Form long-lasting connections with a trusted and respected group of peers with whom you have
                            had meaningful discussions over the course of months
                        </li>
                    </ul>
                    <a name="members">
                        <br><br><br>
                    </a>
                    <h3 style="font-weight:bold;margin-top:0">Members</h3>
                    <span style="font-weight:bold;color:black">Who will be in my group?</span>
                    <p>Each group will include 7-10 MIT Alums in similar career and life stages. We will try to
                        diversify each group&rsquo;s composition where it makes sense.</p>
                    <span style="font-weight:bold;color:black">Are MIT Circles mainly for folks who work in tech?</span>
                    <p>We intend to make MIT Circles diverse to enable a more interesting experience for everyone. As a
                        part of that, we encourage all kinds of professions and backgrounds to apply.</p>
                    <span style="font-weight:bold;color:black">Who are the Leads and how are they chosen?</span>
                    <p style="margin-bottom:0">Leads will be selected first and foremost based on their willingness to
                        accept the responsibilities and invest the additional time and effort that is needed to be an
                        effective Lead. If you express interest in being a Lead, the program administrators will reach
                        out with more information.</p>
                    <a name="meetings">
                        <br><br><br>
                    </a>
                    <h3 style="font-weight:bold;margin-top:0">Meetings</h3>
                    <span style="font-weight:bold;color:black">What does a typical meeting look like?</span>
                    <p>During group meetings, participants will take turns sharing a personal or professional experience
                        or challenge, which the other members of the circle will respond to with questions, advice, and
                        their own reflections. The group may also choose a specific theme to focus on and have a
                        participant present on a relevant situation to set up the discussion. We will provide reference
                        content and suggestions to help the group shape the style that works best for its members.
                    </p>
                    <span style="font-weight:bold;color:black">What do people talk about in Circles?</span>
                    <p>Meeting structure and topics of discussion vary greatly from group to group, but they can include
                        any issues facing us these days, such as:</p>
                    <ul>
                        <li>Career management (e.g. planning, progression, pivots, reentering the workplace)
                        </li>
                        <li>Communication (e.g. for different scenarios and audiences, speaking up, conflict resolution,
                            negotiation)
                        </li>
                        <li>Organizational dynamics (e.g. cross-functional navigation, influence, managing up,
                            unconscious bias)
                        </li>
                        <li>People management (e.g. coaching, motivation, hiring, performance management)
                        </li>
                        <li>Professional development (e.g. executive presence, personal brand, imposter syndrome,
                            emotional intelligence)
                        </li>
                        <li>Business challenges (e.g. strategy, decision-making, business acumen)
                        </li>
                        <li>Personal challenges (e.g. work/family balance, burnout, self-care, relationships)
                        </li>
                        <li>Expand network (e.g. connect with other MIT alums)
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">Where are Circles meetings held? How does the group meet virtually?</span>
                    <p>Given the current situation, it is recommended that Circles conduct their meetings virtually
                        (e.g., via Zoom or Google Meet). In the future, this may change, as in-person meetings confer
                        significant advantages in terms of immediacy, focus, etc. amongst participants.</p>
                    <span style="font-weight:bold;color:black">How often will my group meet and for how long?</span>
                    <ul>
                        <li><strong>Initial meeting:</strong> For the first 2-3 sessions, it is recommended that the
                            group meet weekly for one hour each time (or have 1 extended session). This will enable the
                            group members to get to know one another and build the trust foundations to get things
                            going.
                        </li>
                        <li><strong>Ongoing meetings:</strong> Thereafter, the group will determine specific meeting
                            dates and times, with the recommendation being bi-weekly meetings of one hour each. Exact
                            timing/dates will be based on the group members' availabilities, but consistent attendance
                            is required. This will enable the group to build deep relationships and drive meaningful
                            discussions.
                        </li>
                        <li><strong>Timeline:</strong> Circles groups will run for a trial period of about one
                            six-month, after which each group will decide whether it wants to continue meeting or
                            reshuffle with other groups.
                        </li>
                        <li><strong>Maintaining continuity:</strong> Canceling a meeting can and most probably will have
                            a negative effect on the members&rsquo; ability to reconnect. In general, it is advised to
                            go through with a planned meeting as long as at least 50% of the group is present.
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">What happens if I miss a session?</span>
                    <p style="margin-bottom:0">Consistent attendance is expected of all MIT Circles participants in
                        order to maximize the value for participants. If you need to miss a session, please inform your
                        Circle as soon as possible. Circle Leads will be asked to reach out to participants that miss
                        more than 1 session out of the first few (or tend to be late / leave early) and those
                        participants may be removed from the Circle at the program administrators&rsquo; discretion.</p>
                    <a name="requirements">
                        <br><br><br>
                    </a>
                    <h3 style="font-weight:bold;margin-top:0">Requirements</h3>
                    <span style="font-weight:bold;color:black">My schedule is unpredictable so I can&rsquo;t commit to attending all or most meetings. Can I still join?</span>
                    <p>Participants are expected to join for all sessions barring extenuating circumstances - this
                        ensures a sense of mutual respect and support. After all, the value of MIT Circles is driven by
                        active engagement and participation, so showing up consistently is a key to success.</p>
                    <span style="font-weight:bold;color:black">Are there specific norms that participants are expected to respect?</span>
                    <p>Yes, participants are expected to respect a set of norms that include the following:</p>
                    <ul>
                        <li><strong>Confidentiality:</strong> Avoid sharing any information or observations shared
                            during meetings with non-members, whether colleagues, partners, spouses or friends. This
                            helps to ensure that participants can share openly and honestly and that information is not
                            provided out of context or in a way that might make the sharer uncomfortable about sharing
                            again in the future.
                        </li>
                        <li><strong>Openness:</strong> Commit to being as open as possible about personal matters with
                            members of the group, with the understanding that everything will be held in strictest
                            confidence. However, please be respectful about not pushing other participants to share
                            beyond their comfort zone on personally sensitive matters.
                        </li>
                        <li><strong>Trust:</strong> Join your Circle with the assumption that its members are worthy of
                            trust. Understand that trust is built through honest, open communications and caring for
                            other members of the group.
                        </li>
                        <li><strong>Full Attention:</strong> Commit to practicing active listening and to avoiding
                            interrupting others while they are speaking.
                        </li>
                        <li><strong>Withholding Judgement: </strong>Commit to withholding judgement of group members and
                            avoid giving unsolicited advice. Try not to impose your values and beliefs on other members.
                        </li>
                        <li><strong>Feedback:</strong> Seek to offer and receive constructive feedback from others in
                            the group on ideas, behavior, leadership traits, and communications styles.
                        </li>
                        <li><strong>Attendance:</strong> Make every effort to attend all meetings scheduled for the
                            group, to be on time, and to not leave early unless there are extenuating circumstances.
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">Does it cost anything?</span>
                    <p>There is no program participation fee, but participation does require that you are an MIT Club of
                        Northern California member (MITCNC). You can become a member <a
                                href="/membership/join-or-renew/">here</a> ($50/year), and becoming a member will
                        provide you with access to numerous other MITCNC events throughout the year as well.&nbsp;</p>
                    <span style="font-weight:bold;color:black">Who is eligible to participate in the program? What if I've moved away from the Bay Area during the pandemic?</span>
                    <p style="margin-bottom:0">All members of MITCNC who reside, work, or have their life center in
                        NorCal are invited to join. We do prefer MIT Circles to be composed of people that are
                        geographically close to enable future in-person meetings, but this is not a strict requirement
                        (especially given the uncertainty of the current situation).</p>
                    <a name="misc">
                        <br><br><br>
                    </a>
                    <h3 style="font-weight:bold;margin-top:0">Misc</h3>
                    <span style="font-weight:bold;color:black">What if my career/professional situation changes significantly during the 6 month program? Will I stay in the same circle?</span>
                    <p>Yes, once Circles are in motion, they will run together until the end of the cohort. Oftentimes,
                        some of the most interesting conversations for Circles arise in the context of inflection points
                        / transitions that participants are making.</p>
                    <span style="font-weight:bold;color:black">How do you decide whether to accept an applicant into the program?</span>
                    <p>We will admit applicants based on their expressed commitment to the program and our ability to
                        match them with a Circle that matches their interests. The first Circles cohort will have a
                        limited scope because it is a pilot (both due to logistical factors and in order to maximize
                        testing objectives). We cannot guarantee everyone's participation.</p>
                    <span style="font-weight:bold;color:black">What is the timeline?</span>
                    <table>
                        <tbody style="line-width:100%">
                        <tr>
                            <td>
                                <p>Milestone</p>
                            </td>
                            <td>
                                <p>Date</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Application survey <br>submission deadline&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </td>
                            <td>
                                <p>Tuesday, 09/29/2020</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Circle formation</p>
                            </td>
                            <td>
                                <p>Saturday, 10/17/2020</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Circles kickoffs</p>
                            </td>
                            <td>
                                <p>The week beginning Monday 11/2/2020</p>
                                <p>(specific dates TBD by each Circle)</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Circles wrap-up</p>
                            </td>
                            <td>
                                <p>Saturday, 5/1/2021</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <span style="font-weight:bold;color:black">I have a conflict of interest/direct competition/prior conflict with someone in my Circle. What should I do?</span>
                    <p style="margin-bottom:0">Please let us know after your first Circle if you fear that
                        background/prior history with someone from your circle will make you feel uncomfortable sharing
                        challenges openly and honestly. The program administrators will make best efforts to address
                        these situations appropriately and on a case-by-case basis.</p>
                    <a name="leads">
                        <!--Having the <a name...> tags before the
                        h3 heading is a way to make the link
                        behave well with the top-bar menu on the
                        site.  When we test the method you'd
                        expect, of having the <a name> around the
                        top menu, the link would load with the
                        heading behind the h3.  I recommend
                        reviewing the behavior of the top menu in
                        a PR that affects the entire site. -kerobinso -->
                        <br><br><br>
                    </a>
                    <h3 style="font-weight:bold;margin-top:0">Prospective Leads</h3>
                    <p>One member of each Circle will be a Circle Lead, an important role that requires additional time
                        and effort but also provides additional meaningful opportunities to enable the success of your
                        Circle.</p>
                    <span style="font-weight:bold;color:black">How will I know what to do?</span>
                    <p>Circle Leads will receive:</p>
                    <ul>
                        <li>Special trainings and coaching from expert facilitators
                        </li>
                        <li>Support from other Leads via regular syncs (in addition to regular Circles meetings) and
                            other channels
                        </li>
                        <li>Suggested session agenda, content templates, and other materials</li>
                    </ul>
                    <span style="font-weight:bold;color:black">What&rsquo;s in it for me?&nbsp;</span>
                    <p>Circle Leads will have opportunities to:</p>
                    <ul>
                        <li>Create a small community of meaningful personal and professional relationships, both with
                            the group you lead and other Circle leaders
                        </li>
                        <li>Instill communication and facilitation habits that are useful in everyday life&nbsp; through
                            moderation training and expert support from a professional facilitator
                        </li>
                        <li>Give back by cultivating a learning, inclusive, and connected MIT community
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">As a Circle Lead, am I strictly a facilitator or do I also get to participate as a Circle member?</span>
                    <p>Leads are Circle members first and foremost - we expect the experience to be every bit as
                        rewarding for a Lead as for a non-Lead participant (perhaps even more rewarding!). However,
                        Leads do take on additional responsibilities to help ensure that their Circles run smoothly and
                        effectively.</p>
                    <span style="font-weight:bold;color:black">What does leading a group require from me?&nbsp;</span>
                    <ul>
                        <li>Kick-off the group: Schedule the first few sessions.
                        </li>
                        <li>Facilitate the meetings: During meetings, Leads are expected to help the group bond, align
                            on goals/regular schedule/norms, and stay on track. That being said, there are no strict
                            requirements on curriculum to cover and over time we expect facilitation needs to become
                            minimal. Circles operate on a voluntary, collaborative model where everyone is expected to
                            pitch in to support the group&rsquo;s activities. We will also provide the needed guidance
                            and content to support the Leads.
                        </li>
                        <li>Be the liaison: Be the person in charge for communications with the broader program
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">What is the timeline?</span>
                    <p>Below is the same timeline from above with the Lead-specific milestones added in
                        <strong>bold</strong>.</p>
                    <table>
                        <tbody style="line-height:100%">
                        <tr>
                            <td>
                                <p>Milestone</p>
                            </td>
                            <td>
                                <p>Date</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Application survey <br>submission deadline&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            </td>
                            <td>
                                <p>Tuesday, 09/29/2020</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>Lead selection</strong></p>
                            </td>
                            <td>
                                <p><strong>Saturday, 10/10/2020</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Circle formation</p>
                            </td>
                            <td>
                                <p>Saturday, 10/17/2020</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p><strong>Lead training</strong></p>
                            </td>
                            <td>
                                <p><strong>During the week beginning Monday, 10/19/2020 <br>(specific dates
                                        TBD)</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Circles kickoffs</p>
                            </td>
                            <td>
                                <p>The week beginning Monday 11/2/2020
                                    <br>(specific dates TBD by each Circle)</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Circles wrap-up</p>
                            </td>
                            <td>
                                <p>Saturday, 5/1/2021</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <span style="font-weight:bold;color:black">What is the typical time commitment for a Lead (outside of meetings)?</span>
                    <ul>
                        <li>Training workshop: 2 hours
                        </li>
                        <li>Coordination prior to first few meetings: 30-60 minutes per week
                        </li>
                        <li>Additional intermediate Leads meetings: Optional check-ins with other Circle leads
                        </li>
                    </ul>
                    <span style="font-weight:bold;color:black">When will I know who is in my group?</span>
                    <p>Once we confirm your ability to lead a group, we will share with you the details of your group to
                        ensure its composition makes sense to you.</p>
                    <span style="font-weight:bold;color:black">Can you reshuffle the people in my group?</span>
                    <p>The program administrators will make every effort to create MIT Circles that will have the
                        potential for positive group dynamics, so we will not reshuffle people unless there is a very
                        good reason to do so. Please reach out to us if you think there is a very good reason to
                        reshuffle the group and we can discuss.</p>
                    <span style="font-weight:bold;color:black">Can I add a new member to my group?</span>
                    <p>To maintain fairness, please do not unilaterally add people to your MIT Circle. If you have
                        questions about this, please contact the program administrators.</p>
                    <span style="font-weight:bold;color:black">Someone in my group has missed the first two meetings. What should I do?</span>
                    <p>Please reach out to the person and ask them to provide some context and request a firm commitment
                        that they will attend future meetings. If they continue to fail in meeting the attendance
                        expectations, please let the program administrators know and we will let them know that they
                        will be removed from the group to preserve the group norms and improve group dynamics.</p>
                </div>
            </div>
    </article>

    <article class="speaker-list">
        <div class="container">
            <div class="row">
                <div class="col-sm-24">
                    <h2>Volunteers</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-24">
                    <p class="">
                        Check out some of the active volunteers who are making &pi; r<sup>2</sup> MIT Circles happen:
                    </p>
                </div>
            </div>
            <div class="row users_list">
                <!-- begin hardcoded volunteers -->
                <!-- GAL -->
                <div class="col-lg-8 col-md-12" data-team_member="google ai gal antonovsky">
                    <div class="speaker-card">
                        <a href="/galant">
                            <div class="card-img">
                                <img src="<?php echo esc_url($upload_uri); ?>/2020/09/Gal-Antonovsky.png"
                                     alt="Gal Antonovsky">
                                <div class="icon-mit">
                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="MIT alum">
                                </div> <!-- closes icon-mit-->
                            </div> <!-- closes card-img -->
                            <div class="card-text">
                                <div class="name">
                                    <h3>Gal Antonovsky</h3>
                                    <span class="code">MBA '17</span>
                                </div>
                                <div class="company-name ">
                                    <h4>Google</h4>
                                    <span>Product Manager, AI</span>
                                </div>

                                <div class="border-dotted"></div>

                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/gal-antonovsky/" target="_blank">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg"
                                                 alt="LinkedIn logo">
                                        </a>

                                    </li>
                                </ul>
                            </div><!-- closes card-text -->
                        </a><!-- closes link to mitcnc.org/username -->
                    </div><!--closes speaker-card -->
                </div><!-- closes col-12 ... !! this is the end of the volunteer's info. -->
                <!-- TEDDY -->
                <div class="col-lg-8 col-md-12" data-team_member="scale teddy lee">
                    <div class="speaker-card">
                        <a href="/teddy/">
                            <div class="card-img">
                                <img src="<?php echo esc_url($upload_uri); ?>/2020/07/Teddy-Lee.png" alt="Teddy Lee">
                                <div class="icon-mit">
                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="MIT alum">
                                </div> <!-- closes icon-mit-->
                            </div> <!-- closes card-img -->
                            <div class="card-text">
                                <div class="name">
                                    <h3>Teddy Lee</h3>
                                    <span class="code">MBA '17</span>
                                </div>
                                <div class="company-name ">
                                    <h4>Scale</h4>
                                    <span>Customer Operations</span>
                                </div>

                                <div class="border-dotted"></div>

                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.linkedin.com/in/teddylee543/" target="_blank">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg"
                                                 alt="LinkedIn">
                                        </a>

                                    </li>
                                </ul>
                            </div><!-- closes card-text -->
                        </a>
                    </div><!-- closes speaker-card -->
                </div><!-- closes col-12 ... !! this is the end of the volunteer's info. -->
                <!-- KAREN -->
                <div class="col-lg-8 col-md-12" data-team_member="karen robinson">
                    <div class="speaker-card">
                        <a href="https://www.mitcnc.org/karenrobinson/">
                            <div class="card-img">
                                <img src="<?php echo esc_url($upload_uri); ?>/2020/09/karenerobinson-2018.png"
                                     alt="Karen E. Robinson">
                                <div class="icon-mit">
                                    <img src="<?php echo esc_url($assets_uri); ?>/images/mit-icon.svg" alt="MIT alum">
                                </div> <!-- closes icon-mit-->
                            </div> <!-- closes card-img -->
                            <div class="card-text">
                                <div class="name">
                                    <h3>Karen E. Robinson</h3>
                                    <span class="code">SB '02</span>
                                </div>

                                <div class="border-dotted"></div>

                                <div class="tags-box">
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="https://www.twitter.com/kerobinso" target="_blank"
                                           alt="kerobinso on twitter">
                                            <img src="https://www.mitcnc.org/app/themes/mitcnc/assets/images/tw.svg">
                                        </a>

                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/in/karenerobinson/" target="_blank">
                                            <img src="<?php echo esc_url($assets_uri); ?>/images/in.svg"
                                                 alt="LinkedIn">
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- closes card-text -->
                        </a><!-- closes link to mitcnc.org/username -->
                    </div><!--closes speaker-card -->
                </div><!-- closes col-12 ... !! this is the end of the volunteer's info. -->

            </div><!--closes row speaker-container -->

            <?php
        }
    }
    ?>
</section>
<?php get_footer(); ?>
    
