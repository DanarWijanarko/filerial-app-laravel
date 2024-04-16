<?php

namespace Database\Seeders;

use App\Models\Favorite;

class FavoriteSeeder
{
    static public function drama($userId)
    {
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "215720",
                "name" => "Queen of Tears",
                "slug" => "queen-of-tears",
                "poster" => "https://image.tmdb.org/t/p/original/7ZXLZ3KYL3IVvsSHBZaHjcNQzNU.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/wcP3FsRLog4GNEs9PFrDKKQdcof.jpg",
                "overview" => "The queen of department stores and the prince of supermarkets weather a marital crisis—until love miraculously begins to bloom again.",
                "mediaType" => "shows",
                "release_date" => "March 09, 2024",
                "vote_average" => "8.1",
                "origin_country" => "South Korea"
            ],
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "119769",
                "name" => "Taxi Driver",
                "slug" => "taxi-driver",
                "poster" => "https://image.tmdb.org/t/p/original/jtnexp4UhLkvSuBya3W4Ir916fb.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/i1SyUHsi45psSH1xy9sM0in8FKJ.jpg",
                "overview" => "A former special forces soldier delivers revenge for victims of injustice while working for a secret organization that fronts as a taxi company.",
                "mediaType" => "shows",
                "release_date" => "April 09, 2021",
                "vote_average" => "8",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "208825",
                "name" => "Parasyte: The Grey",
                "slug" => "parasyte-the-grey",
                "poster" => "https://image.tmdb.org/t/p/original/rubaKfmdCvWGPXErgW9aQsgzKVr.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/p4rJTY1rvQrffoh2P09sty5cz8B.jpg",
                "overview" => "When unidentified parasites violently take over human hosts and gain power, humanity must rise to combat the growing threat.",
                "mediaType" => "shows",
                "release_date" => "April 05, 2024",
                "vote_average" => "7.8",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "215072",
                "name" => "A Shop for Killers",
                "slug" => "a-shop-for-killers",
                "poster" => "https://image.tmdb.org/t/p/original/7yUY1HUyQuybbvkAAhLzQ7x1l9g.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/z5v9pz0h5R2rzmk9HuboODMhzQp.jpg",
                "overview" => "A niece who lost her parents and grew up in the hands of an uncle who runs a shopping mall faces a new truth after her uncle's sudden death.",
                "mediaType" => "shows",
                "release_date" => "January 17, 2024",
                "vote_average" => "8.3",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "108284",
                "name" => "Tale of the Nine Tailed",
                "slug" => "tale-of-the-nine-tailed",
                "poster" => "https://image.tmdb.org/t/p/original/jXx9vLO9bwKxl81oVQnzEH7960V.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/oPJQvS8Xyg7chAX0jQoC2smqMxv.jpg",
                "overview" => "A TV producer discovers a secret supernatural world as she becomes entangled with a former deity who's spent centuries searching for his lost lover.",
                "mediaType" => "shows",
                "release_date" => "October 07, 2020",
                "vote_average" => "8.4",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "220074",
                "name" => "Flex x Cop",
                "slug" => "flex-x-cop",
                "poster" => "https://image.tmdb.org/t/p/original/rEuuCZb7PsVzRYJ1DiWJZ7QYFqn.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/nOGPxfYqd0f3oeFGGinpDOP68MQ.jpg",
                "overview" => "A chaebol cop joins forces with a gritty detective to take down criminals with a touch of wealth and a whole lot of wit.",
                "mediaType" => "shows",
                "release_date" => "January 26, 2024",
                "vote_average" => "8",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "138663",
                "name" => "Café Minamdang",
                "slug" => "cafe-minamdang",
                "poster" => "https://image.tmdb.org/t/p/original/jFXSdUd12KzpIKixEmTL0P7osxP.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/omY2At0U5zPDYnhxPLD79ZfZIXO.jpg",
                "overview" => "A suspicious business that offers the services of a purportedly all-knowing shaman catches the attention of a tenacious police inspector.",
                "mediaType" => "shows",
                "release_date" => "June 27, 2022",
                "vote_average" => "7.3",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "82032",
                "name" => "Player",
                "slug" => "player",
                "poster" => "https://image.tmdb.org/t/p/original/6z5GNHh4J0AC1W8TyIwV8Xnby61.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/wmbUnuBa1YYUXMoZJiXs5cMThXO.jpg",
                "overview" => "The story about the revenge of four talented individuals in their respective fields who create an elite team to solve crimes.",
                "mediaType" => "shows",
                "release_date" => "September 29, 2018",
                "vote_average" => "7.3",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "94510",
                "name" => "Leverage",
                "slug" => "leverage",
                "poster" => "https://image.tmdb.org/t/p/original/ytn72pDhQcRq9LKbare5fnQrEiY.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/eDoemU0ZJxcOngpofKZS5z4kKat.jpg",
                "overview" => "There are countless incidents happening in one day. The corruption of the upper class discourages the common people who are living their lives diligently. From immorality to financial fraud, and they even commit a highly developed type of expedient. The victims of corruption are us, the common people. However, we have no choice but to be relieved that the victim is not me at least for this time. To turn the table, the best experts in each field have gathered! The former insurance investigator, Tae Joon, has a son who is terminally ill. To save his son, he accepts the deal which is extremely dangerous. And his life completely changes after that day. He organizes a team to get back at those corrupted rich people. With Su Kyung, Na Byeol, Roy, and Eui Sung, Tae Joon approaches to the conspiracy. Self-interest is rampant in our society, but through their journey to exposing the corruption, they begin to understand each other at the end.",
                "mediaType" => "shows",
                "release_date" => "October 13, 2019",
                "vote_average" => "7.8",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "201852",
                "name" => "One Dollar Lawyer",
                "slug" => "one-dollar-lawyer",
                "poster" => "https://image.tmdb.org/t/p/original/AoyepneE9LkLSlVKdJb33mcXfFe.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/o4zSmny1pwGHAlULbtmLbUdRrNn.jpg",
                "overview" => "Courts are not equally accessible to everyone and people lose trust in the judicial system. But here comes a lawyer with the best skills and a commission fee of just one dollar, committed to social justice and defending fundamental human rights. This extraordinary defense lawyer confronts blindfolded justice and highly paid opposing counsel for his clients' rights.",
                "mediaType" => "shows",
                "release_date" => "September 23, 2022",
                "vote_average" => "7.3",
                "origin_country" => "South Korea"
            ]
        ]);
    }

    static public function person($userId)
    {
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "2112859",
                "name" => "Han So-hee",
                "slug" => "han-so-hee",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/8IvEOnqMjqJWcci3z44haH38Ee8.jpg",
                "birthday" => "November 18, 1994",
                "biography" => "Han So-hee (born Lee So-hee on November 18, 1994) is a South Korean actress. She began her career as a supporting character in the television series Money Flower (2017), 100 Days My Prince (2018), and Abyss (2019) before transitioning into lead roles in The World of the Married (2020), Nevertheless (2021), and My Name (2021).",
                "mediaType" => "person",
                "popularity" => "27.69"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1089693",
                "name" => "Oh Yeon-seo",
                "slug" => "oh-yeon-seo",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/dmXIeZ3ARlB6z52MXuc8VpLoWut.jpg",
                "birthday" => "June 22, 1987",
                "biography" => "Oh Yeon-seo (오연서), born Oh Haet-nim (오햇님), is a South Korean actress and former member of the girl group LUV.",
                "mediaType" => "person",
                "popularity" => "19.93"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1330917",
                "name" => "Krystal Jung",
                "slug" => "krystal-jung",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/nD2rqT1Z0veXgcti6d9E61OqOx6.jpg",
                "birthday" => "October 24, 1994",
                "biography" => "Jung Soo Jung (Hangul: 정수정; born October 24, 1994) but better known as Krystal, is an American-born South Korean idol singer and actress. Discovered by SM Entertainment in 2000, she began filming for commercials and music videos by 2002. She is currently a member of the Korean quintet girl group f(x), formed by SM Entertainment in 2009.\r\n\r\nKrystal was born in San Francisco, California, where her family from South Korea settled in the 1980s. During a family trip to South Korea in early 2000 when Krystal was five, she was spotted by talent agency SM Entertainment, which earned her a cameo appearance in Shinhwa's \"Wedding March\" music video. The agency saw potential in Krystal and offered her singing and dancing lessons, opting to professionally train her in a singing career. However, the offer was turned down by her parents, reasoning that Krystal was too young. Instead, her parents allowed her older sister Jessica Jung to join the agency, who debuted as a member of the girl group Girls' Generation in August 2007.\r\n\r\nIn 2002, Krystal began appearing in television commercials. She first appeared in a Lotte commercial with Korean actress Han Ga In. In 2006, her parents allowed her to join SM Entertainment, and the agency enrolled her in dance classes, including hip hop and jazz. According to an exclusive media outlet report on August 18, Krystal has decided to part ways with her agency, SM Entertainment.",
                "mediaType" => "person",
                "popularity" => "14.242"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "83020",
                "name" => "Song Seung-heon",
                "slug" => "song-seung-heon",
                "gender" => "Male",
                "profile" => "https://image.tmdb.org/t/p/original/AloHkgRwhj3BzCKClXxPInjbW9R.jpg",
                "birthday" => "October 05, 1976",
                "biography" => "Song Seung-heon (송승헌) is a South Korean actor. Song is noted for his roles in Korean dramassuch as Autumn in My Heart, Summer Scent, and East of Eden.",
                "mediaType" => "person",
                "popularity" => "15.714"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "144591",
                "name" => "Kim Sae-ron",
                "slug" => "kim-sae-ron",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/gV5WUw4GiKeTiPO0RgZ2GHyL9Yv.jpg",
                "birthday" => "July 31, 2000",
                "biography" => "Kim Sae-ron  (born July 31, 2000) is South Korean actress who best known for her roles A Brand New Life (2009) and The Man From Nowhere (2010) which she won Best New Actress at Korean Film Awards.",
                "mediaType" => "person",
                "popularity" => "21.219"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "122408",
                "name" => "Lee Joon-gi",
                "slug" => "lee-joon-gi",
                "gender" => "Male",
                "profile" => "https://image.tmdb.org/t/p/original/tHPJUgGiQRWt1Bh7ymqmmJ2zKF6.jpg",
                "birthday" => "April 17, 1982",
                "biography" => "Lee Joon-gi (이준기) is a South Korean actor and singer. He was born on April 17th, 1982. He rose to fame as Gong-gil in \"The King and the Clown\". In August 2009, Lee was appointed an ambassador for Korea tourism by the Korea Tourism Organization.",
                "mediaType" => "person",
                "popularity" => "31.01"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1248204",
                "name" => "Moon Chae-won",
                "slug" => "moon-chae-won",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/gLQFQi9U6CwEmK6DmagItBBp4XF.jpg",
                "birthday" => "November 13, 1986",
                "biography" => "From Wikipedia, the free encyclopedia.\r\n\r\nMoon Chae-won (born November 13, 1986) is a South Korean actress. Moon first attracted attention in 2008 in her supporting role as a gisaeng in Painter of the Wind. She was next cast in Brilliant Legacy, one of the top-rated Korean dramas of 2009. 2011 marked Moon's career breakthrough, with leading roles in the television period drama The Princess' Man and the action blockbuster War of the Arrows; both were critical and commercial hits, with Arrows as the highest grossing Korean film of the year. For her performance in the latter, Moon won Best New Actress at the Grand Bell Awards and the Blue Dragon Film Awards. Moon's other notable television series include the revenge melodrama The Innocent Man (2012) and the humanistic medical drama Good Doctor (2013).",
                "mediaType" => "person",
                "popularity" => "13.993"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1716008",
                "name" => "Lee Sun-bin",
                "slug" => "lee-sun-bin",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/8YwNd9PhSym4357gCu9RCDdPXqx.jpg",
                "birthday" => "January 07, 1994",
                "biography" => "Lee Sun-bin (born Lee Jin-kyung on January 7, 1994) is a South Korean actress and singer. She is known for starring in Squad 38, Missing 9 and Criminal Minds. She joined girl group JQT following Minsun's departure in September 2011, until the group's disbandment in 2012.",
                "mediaType" => "person",
                "popularity" => "19.163"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "2334143",
                "name" => "Kim Ji-eun",
                "slug" => "kim-ji-eun",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/e2wQP0Cj96kRn9qJmwBpnSZ2YRa.jpg",
                "birthday" => "October 09, 1993",
                "biography" => null,
                "mediaType" => "person",
                "popularity" => "17.32"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "126743",
                "name" => "Lee Chung-ah",
                "slug" => "lee-chung-ah",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/55UFbVcSLmkOxAplWWUMgRUXkAh.jpg",
                "birthday" => "October 25, 1984",
                "biography" => null,
                "mediaType" => "person",
                "popularity" => "23.047"
            ]
        ]);
    }
    static public function person2($userId)
    {
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1799123",
                "name" => "Kwon Na-ra",
                "slug" => "kwon-na-ra",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/4U0cNinwOf7DdsBYA3BFi7arDmz.jpg",
                "birthday" => "March 13, 1991",
                "biography" => null,
                "mediaType" => "person",
                "popularity" => "13.236"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1333419",
                "name" => "Seo Hyun-jin",
                "slug" => "seo-hyun-jin",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/pevSdOgAhz9a75ixFqbf420vK7J.jpg",
                "birthday" => "February 27, 1985",
                "biography" => null,
                "mediaType" => "person",
                "popularity" => "19.624"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1716008",
                "name" => "Lee Sun-bin",
                "slug" => "lee-sun-bin",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/8YwNd9PhSym4357gCu9RCDdPXqx.jpg",
                "birthday" => "January 07, 1994",
                "biography" => "Lee Sun-bin (born Lee Jin-kyung on January 7, 1994) is a South Korean actress and singer. She is known for starring in Squad 38, Missing 9 and Criminal Minds. She joined girl group JQT following Minsun's departure in September 2011, until the group's disbandment in 2012.",
                "mediaType" => "person",
                "popularity" => "19.163"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "2334143",
                "name" => "Kim Ji-eun",
                "slug" => "kim-ji-eun",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/e2wQP0Cj96kRn9qJmwBpnSZ2YRa.jpg",
                "birthday" => "October 09, 1993",
                "biography" => null,
                "mediaType" => "person",
                "popularity" => "17.32"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "126743",
                "name" => "Lee Chung-ah",
                "slug" => "lee-chung-ah",
                "gender" => "Female",
                "profile" => "https://image.tmdb.org/t/p/original/55UFbVcSLmkOxAplWWUMgRUXkAh.jpg",
                "birthday" => "October 25, 1984",
                "biography" => null,
                "mediaType" => "person",
                "popularity" => "23.047"
            ]
        ]);
    }
    static public function movies($userId)
    {
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "654739",
                "name" => "Hard Hit",
                "slug" => "hard-hit",
                "poster" => "https://image.tmdb.org/t/p/original/y2Aimt8isimtigec3e4kB2G9FMR.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/atPlFdUrQl2U9MtUwujrrjnQHBA.jpg",
                "overview" => "On his way to work, a bank manager receives an anonymous call claiming there's a bomb under his car seat, and if anyone exits the car, it will explode unless he can pay a ransom.",
                "mediaType" => "movies",
                "release_date" => "June 23, 2021",
                "vote_average" => "7.6",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "882569",
                "name" => "Guy Ritchie's The Covenant",
                "slug" => "guy-ritchies-the-covenant",
                "poster" => "https://image.tmdb.org/t/p/original/kVG8zFFYrpyYLoHChuEeOGAd6Ru.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/eTvN54pd83TrSEOz6wbsXEJktCV.jpg",
                "overview" => "During the war in Afghanistan, a local interpreter risks his own life to carry an injured sergeant across miles of grueling terrain.",
                "mediaType" => "movies",
                "release_date" => "April 19, 2023",
                "vote_average" => "7.8",
                "origin_country" => "United Kingdom"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "933131",
                "name" => "Badland Hunters",
                "slug" => "badland-hunters",
                "poster" => "https://image.tmdb.org/t/p/original/sdI9ufheNPAKnWLl2hnsZKVk0EG.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/pWsD91G2R1Da3AKM3ymr3UoIfRb.jpg",
                "overview" => "After a deadly earthquake turns Seoul into a lawless badland, a fearless huntsman springs into action to rescue a teenager abducted by a mad doctor.",
                "mediaType" => "movies",
                "release_date" => "January 25, 2024",
                "vote_average" => "6.8",
                "origin_country" => "South Korea"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "1011985",
                "name" => "Kung Fu Panda 4",
                "slug" => "kung-fu-panda-4",
                "poster" => "https://image.tmdb.org/t/p/original/kDp1vUBnMpe8ak4rjgl3cLELqjU.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/1XDDXPXGiI8id7MrUxK36ke7gkX.jpg",
                "overview" => "Po is gearing up to become the spiritual leader of his Valley of Peace, but also needs someone to take his place as Dragon Warrior. As such, he will train a new kung fu practitioner for the spot and will encounter a villain called the Chameleon who conjures villains from the past.",
                "mediaType" => "movies",
                "release_date" => "March 02, 2024",
                "vote_average" => "7.1",
                "origin_country" => "United States"
            ]
        ]);
        Favorite::factory()->create([
            'user_id' => $userId,
            'data' => [
                "id" => "496243",
                "name" => "Parasite",
                "slug" => "parasite",
                "poster" => "https://image.tmdb.org/t/p/original/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg",
                "backdrop" => "https://image.tmdb.org/t/p/original/TU9NIjwzjoKPwQHoHshkFcQUCG.jpg",
                "overview" => "All unemployed, Ki-taek's family takes peculiar interest in the wealthy and glamorous Parks for their livelihood until they get entangled in an unexpected incident.",
                "mediaType" => "movies",
                "release_date" => "May 30, 2019",
                "vote_average" => "8.5",
                "origin_country" => "South Korea"
            ]
        ]);
    }
}
