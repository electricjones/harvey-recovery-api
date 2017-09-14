<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Harvey Recovery Status</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header class="tracker__header">
    <div class="wrapper"><h1><span class="callout">Harvey</span> Recovery Status</h1></div>
</header>
<div class="wrapper">
    <div class="tracker__content">
        <div class="tracker__right">
            <div class="tracker__update-callout">
                <div class="tracker__timestamp"><p class="time">{{ $survey->updated_at->format('g:i A') }}</p>
                    <p class="date">{{ $survey->updated_at->format('l, m-d-Y') }}</p></div>
                <p class="tracker__update-details"> Updates will be sent to <br/>
                    <a href="#">{{ substr($user->phone, 0, 3) }}-{{ substr($user->phone, 3, 3) }}-{{ substr($user->phone, 6, 4) }}</a><br/> and<br/>
                    <a href="mailto:{{ $user->email }}">{{ $user->email }}.</a></p><a id="update-button" href="#"
                                                                          class="tracker__button tracker__button--confirm">Check
                    Updates</a></div>
        </div>
        <div class="tracker__left">
            <div class="tracker__alert--first-time"><p><strong>Since this is your first time completing the
                        survey,</strong> please confirm that your area has been declared for FEMA assistance. FEMA is
                    the Federal Emergency Management Agency. When the US President makes a Declaration of Disaster, FEMA
                    administers relief for individuals and business owners who sustained damage and&nbsplosses.</p>
            </div>
            <div id="intro" class="tracker__section"><p>Hi,</p>
                <p>Thanks for completing the survey, designed to deliver just the info you need.</p>
            </div>
            <div id="what-to-do" class="tracker__section"><h2>Do</h2>
                <ol id="to-do-list" class="tracker__list">
                        @if(isset($do))
                            @foreach ($do as $item)
                                <li class="list-item list-item--to-do">
                                <input type="checkbox" id="item1" name="item1" value="item1"
                                                                  class="checkbox"><label for="item1" class="label">
                                    {!! $item !!}
                                </label></li>
                            @endforeach
                        @endif
                </ol>
                <h3>Completed</h3>
                <ul id="completed-to-do-list" class="tracker__list">
                    <li class="list-item list-item--complete">Complete survey</li>
                </ul>
            </div>
            <div id="know" class="tracker__section"><h2>Know</h2>
                <ul class="tracker__list">
                        @if(isset($know))
                            @foreach ($know as $item)
                                <li class="list-item">
                                    {!! $item !!}
                                </li>
                            @endforeach
                        @endif
                </ul>
            </div>
            <div id="weather" class="tracker__section"><a class="weatherwidget-io"
                                                          href="https://forecast7.com/en/29d76n95d37/houston/?unit=us"
                                                          data-font="Arial" data-days="3" data-theme="original"
                                                          data-basecolor="" data-accent="" data-textcolor="#383849"
                                                          data-highcolor="#383849" data-lowcolor="#383849"
                                                          data-suncolor="#4B53DC" data-mooncolor="#4B53DC"
                                                          data-cloudcolor="#383849" data-raincolor="#383849"
                                                          data-snowcolor="#383849"></a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "https://weatherwidget.io/js/widget.min.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "weatherwidget-io-js");</script>
            </div>
            <div id="more-information" class="tracker__section">
                <div id="more-accordion" class="tracker__accordion"><a id="more-button"
                                                                       class="tracker__button tracker__button--accordion">More</a>
                    <p>Call 9-1-1 for emergencies requiring immediate assistance from the law, fire department or an
                        ambulance.</p>
                    <p>If you question whether it’s an emergency, call 9-1-1. Be safe and let the 9-1-1 call-taker
                        determine if you need emergency assistance.</p>
                    <h3>Federal</h3>
                    <ul class="tracker__list">
                        <li class="list-item"><a href="http://www.usa.gov">www.usa.gov</a></li>
                        <li class="list-item"><a href="http://www.disasterassistance.gov">www.disasterassistance.gov</a></li>
                        <li class="list-item"><a href="http://www.fema.gov">www.fema.gov</a></li>
                    </ul>
                    <h3>State</h3>
                    <ul class="tracker__list">
                        <li class="list-item"><a href="https://www.dps.texas.gov/dem/">Texas Division of Emergency Management</a></li>
                        <li class="list-item"><a href="http://dshs.texas.gov/">Texas Department of State Health Services</a></li>
                    </ul>
                    <h3>County</h3>
                    <ul class="tracker__list">
                        <li class="list-item"><a href="http://www.harriscountytx.gov">http://www.harriscountytx.gov</a>
                        </li>
                    </ul>
                    <h3>City</h3>
                    <ul class="tracker__list">
                        <li class="list-item"><a href="http://www.houstontx.gov">City of Houston</a></li>
                        <li class="list-item"><a href="http://www.houstontx.gov/311/">City of Houston 3-1-1 Help and Info</a></li>
                    </ul>
                </div>
                <div id="answer-accordion" class="tracker__accordion"><a id="answer-button"
                                                                         class="tracker__button tracker__button--accordion">Review
                        Answers</a>
                    <ul class="tracker__list">

                        @if(isset($answers))
                            @foreach ($answers as $question => $answer)
                                <li class="list-item">
                                    <strong>{{$question}}</strong>: {{$answer}}
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
                <p>
                    Your information will be used to guide you through this incident and improve this service. No
                    identifying information will be retained after the recovery period.</p>
                <p><a href="/remove-user/{{ $user->id }}">Click here to stop updates and delete yourself from the system now.</a>
                </p>
                <p>This service and site are for general information, not legal advice. Only obtain legal advice from a
                    lawyer. All information here should be current and legal, but accuracy cannot be guaranteed.</p>
            </div>
            <div id="feedback" class="tracker__section">

                <script>
                    function helps() {
                          var xhr = new XMLHttpRequest();
                          xhr.open('GET', '/helpful/{{ $user->id }}');
                          xhr.send(null);

                          console.log('clicked to /helpful/{{ $user->id }}')
                    }
                </script>
                <div class="tracker__inline-cta"><p>Did you find this tool useful?</p><a id="useful-button" href="#"
                        class="tracker__button tracker__button--inline-cta tracker__button--confirm" onclick="helps()">Yes</a>
                    <p class="inline-cta-text">or <a href="https://houston.az1.qualtrics.com/jfe/form/SV_eeMnwav1prXQNi5" target="_blank">report broken links and other feedback</a></p></div>
            </div>
        </div>
    </div>
</div>
<script src="/js/app.js"></script>
</body>
</html>