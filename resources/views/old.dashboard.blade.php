<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My Recovery Status Tracker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Helvetica', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
                line-height: 2;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                max-width: 60%;
                margin: 0 auto;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref"> <!--  full-height -->
            <div class="title m-b-md" style="text-align: center">
                My Recovery Status Tracker
            </div>
        </div>

            <div class="content"> <!-- content -->
                <div style="text-align: left; padding: 2em;">
                    <!-- todo: timestamp -->
                    <p>This information is correct as of <strong>{{ $survey->updated_at->toDayDateTimeString() }}</strong>.
                        Please check your profile for updated information.</p>

                    <p>Hi,</p>

                    <p>Thanks for completing the tracker. We’ll send update to <strong>{{ $user['phone'] }}</strong> and <strong>{{ $user->email }}</strong>.

                    </p>
                    <p>Your info will also stay at <a href="http://e-34-239-254-66.compute-1.amazonaws.com/users/{{ $user_hash }}">this link</a>.</p>

                    <p><em>
                            <!-- todo: first time? -->
                        Since this is your first time completing the tracker, please start by confirming that your area has been declared for FEMA assistance.
                        FEMA is the Federal Emergency Management Agency.
                        When the US President makes a Declaration of Disaster, FEMA administers relief for individuals and business owners who sustained damage and losses.
                    </em></p>

                    <form>

                    <h3>DO</h3>
                        @foreach ($do as $item)
                            <p><input type="checkbox" style="margin-right: 2em;"> {!! $item !!}</p>
                        @endforeach
                    </form>

                    <h3>KNOW</h3>
                    <ul>
                        @foreach ($know as $item)
                            <li>{!! $item !!}</li>
                        @endforeach
                    </ul>

                    <h3>WEATHER</h3>
                    <!-- todo: embed weather -->
                    <img src="/img/weather.jpg">

                    <h3>MORE</h3>
                    <!-- todo: custom "more" section -->
                    <h4>Federal</h4>
                    <ul class="">
                        <li class=""><span class=""><a class="" href="http://www.usa.gov" target="_blank">www.usa.gov</a></span></li>
                        <li class=""><span class=""><a class="" href="http://www.disasterassistance.gov" target="_blank">www.disasterassistance.gov</a></span></li>
                        <li class=""><span class=""><a class="" href="http://www.fema.gov" target="_blank">www.fema.gov</a></span></li>
                    </ul>

                    <h4>State</h4>

                    <ul class="">
                        <li class=""><span class=""><a class="" href="https://gov.texas.gov/hurricane" target="_blank">Texas Division of Emergency Management</a></span><span>.</span></li>
                        <li class=""><span class=""><a class="" href="http://dshs.texas.gov/news/updates.shtm" target="_blank">Texas Department of State Health Services</a></span></li>
                    </ul>

                    <h4>City</h4>

                    <ul class="">
                        <li class=""><span class=""><a class="" href="http://www.houstontx.gov" target="_blank">City of Houston</a></span></li>
                    </ul>

                    <hr>
                    <p><span class="c12">Here are your current answers.</span></p>

                    <ul class="">
                        @foreach ($answers as $item)
                            <li>{!! $item !!}</li>
                        @endforeach
                        {{--<li class=""><span class="">You&rsquo;re filled this out for yourself</span></li>--}}

                        {{--<li class=""><span>You can be reached at 713-555-1212 and </span><span class=""><a class="" href="mailto:harveystationhouston@gmail.com">harveystationhouston@gmail.com</a></span></li>--}}

                        {{--<li class=""><span class="">You need support for dialysis</span></li>--}}

                        {{--<li class=""><span>Your address is </span><span>1301 Fannin St, Houston, 77002</span></li>--}}

                        {{--<li class=""><span class="">4 adults and children in your party</span></li>--}}

                        {{--<li class=""><span class="">You need help finding your automobile</span></li>--}}

                        {{--<li class=""><span class="">You need shelter now</span></li>--}}

                        {{--<li class=""><span class="">You need long-term food supplies</span></li>--}}

                        {{--<li class=""><span class="">Your property was damaged</span></li>--}}

                        {{--<li class=""><span class="">You are the property owner</span></li>--}}

                        {{--<li class=""><span class="">I have insurance and need contact info and reporting tips.</span></li>--}}

                        {{--<li class=""><span class="">You need help mucking.</span></li>--}}
                    </ul>

{{--                    {!! $content !!}--}}
                </div>
            </div>
    </body>
</html>
