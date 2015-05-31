# PHP-YouTube-Download
Small PHP script to download videos from YouTube.com

Installation
-Simply extract this script to your server/hosting.
-execute index.php and enter your desired YOUTUBE ID

This script is storing some algo's to your server/hoting.
Sample: http://developers.wapmon.com/api/youtube/algo?player_id=en_US-vflE8_7k0&sl=42.44

Test cases and examples:

  #   http://www.youtube.com/watch?v=wjzyv2Q_hdM
  #   5-Aug-2011: 38=flv/1080p but 45=webm/720p.
  #   6-Aug-2011: 38 no longer offered.

  #   http://www.youtube.com/watch?v=ms1C5WeSocY
  #   6-Aug-2011: embedding disabled, but get_video_info works.

  #   http://www.youtube.com/watch?v=g40K0dFi9Bo
  #   10-Sep-2011: 3D, fmts 82 and 84.

  #   http://www.youtube.com/watch?v=KZaVq1tFC9I
  #   14-Nov-2011: 3D, fmts 100 and 102.  This one has 2D images in most
  #   formats but left/right images in the 3D formats.

  #   http://www.youtube.com/watch?v=SlbpRviBVXA
  #   15-Nov-2011: 3D, fmts 46, 83, 85, 101.  This one has left/right images
  #   in all of the formats, even the 2D formats.

  #   http://www.youtube.com/watch?v=711bZ_pLusQ
  #   30-May-2012: First sighting of fmt 36, 3gpp/240p.

  #   http://www.youtube.com/watch?v=0yyorhl6IjM
  #   30-May-2013: Here's one that's more than an hour long.

  #   http://www.youtube.com/watch?v=pc4ANivCCgs
  #   15-Nov-2013: First sighting of formats 59 and 78.

  #   http://www.youtube.com/watch?v=WQzVhOZnku8
  #   3-Sep-2014: First sighting of a 24/7 realtime stream.

  #   http://www.youtube.com/watch?v=gTIK2XawLDA
  #   22-Jan-2015: DNA Lounge 24/7 live stream, 640x360.

  #   http://www.youtube.com/watch?v=hHKJ5eE7I1k
  #   22-Jan-2015: 2K video. Formats 36, 136, 137, 138.

  #   http://www.youtube.com/watch?v=udAL48P5NJU
  #   22-Jan-2015: 4K video. Formats 36, 136, 137, 138, 266, 313.

  #   http://www.youtube.com/watch?v=OEhRucEVzH8
  #   20-Feb-2015: best formats 18 (640 x 360) and 135 (854 x 480)
  #   First sighting of a video where we must mux to get the best
  #   non-HD version.

  #   http://www.youtube.com/watch?v=Ol61WOSzLF8
  #   10-Mar-2015: formerly RTMPE but 14-Apr-2015 no longer

  #   http://www.youtube.com/watch?v=1ltcDfZMA3U  Maps
  #   29-Mar-2015: formerly playable in US region, but no longer

  #   http://www.youtube.com/watch?v=ttqMGYHhFFA  Metric
  #   29-Mar-2015: Formerly enciphered, but no longer

  #   http://www.youtube.com/watch?v=7wL9NUZRZ4I  Bowie
  #   29-Mar-2015: Formerly enciphered and content warning; no longer CW.

  #   http://www.youtube.com/watch?v=07FYdnEawAQ Timberlake
  #   29-Mar-2015: enciphered and "content warning" (HTML scraping fails)

  #   http://youtube.com/watch?v=HtVdAasjOgU
  #   29-Mar-2015: content warning, but non-enciphered

  #   http://www.youtube.com/watch?v=__2ABJjxzNo
  #   29-Mar-2015: has url_encoded_fmt_stream_map but not adaptive_fmts

  #   http://www.youtube.com/watch?v=lqQg6PlCWgI
  #   29-Mar-2015: finite-length archive of a formerly livestreamed video.
  #   We currently can't download this, but it's doable.
  #   See dna/backstage/src/slideshow/slideshow-youtube-frame.pl

  #   Enciphered:
  #   http://www.youtube.com/watch?v=ktoaj1IpTbw  Chvrches
  #   http://www.youtube.com/watch?v=28Vu8c9fDG4  Emika
  #   http://www.youtube.com/watch?v=_mDxcDjg9P4  Vampire Weekend
  #   http://www.youtube.com/watch?v=8UVNT4wvIGY  Gotye
  #   http://www.youtube.com/watch?v=OhhOU5FUPBE  Black Sabbath
  #   http://www.youtube.com/watch?v=UxxajLWwzqY  Icona Pop

  #   http://www.youtube.com/watch?v=g_uoH6hJilc
  #   28-Mar-2015: enciphered Vevo (Years & Years) on which CTF was failing

  #   http://www.youtube.com/watch?v=ccyE1Kz8AgM
  #   28-Mar-2015: not viewable in US (US is not on the include list)

  #   http://www.youtube.com/watch?v=ccyE1Kz8AgM
  #   28-Mar-2015: blocked in US (US is on the exclude list)

  #   http://www.youtube.com/watch?v=GjxOqc5hhqA
  #   28-Mar-2015: says "please sign in", but when signed in, it's private

  #   http://www.youtube.com/watch?v=UlS_Rnb5WM4
  #   28-Mar-2015: non-embeddable (Pogo)

  #   http://www.youtube.com/watch?v=JYEfJhkPK7o
  #   14-Apr-2015: RTMPE DRM
  #   get_video_info fails with "This video contains content from Mosfilm,
  #   who has blocked it from display on this website.  Watch on Youtube."
  #   There's a generic rtmpe: URL in "conn" and a bunch of options in
  #   "stream", but I don't know how to put those together into an
  #   invocation of "rtmpdump" that does anything at all.
