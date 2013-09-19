Performance
===========

This lib should not be used to parse a lot of data. However here some highlight on performance

Bench specs:

 * vagrant guest with 2 CPU and 2Gb of RAM running on a i7 8GGb of RAM with OSX
 * phpunit to start ComputeTest.php


Times:

 * Iterating over 250K entries took 0.745s
 * Aggregating 250K entries to compute sum, avg, min, max per key tooks 1.87s and consume 3.75Mb of RAM
 * Enabling the EventDispatcher to be able to compute more statistics add extra time, to a 3.18s
 * Enabling the PercentComputer to be able to compute the average of each group, time: 3.92s

Output sample:

```json
{"sonata.data.8":{"sum":4813161,"min":0,"avg":5066.4852631579},"sonata.data.16":{"sum":4969462,"min":0,"avg":5009.5383064516},"sonata.data.7":{"sum":4849151,"min":0,"avg":4903.084934277},"sonata.data.4":{"sum":5134163,"min":0,"avg":5170.3554884189},"sonata.data.14":{"sum":5027974,"min":0,"avg":4968.3537549407},"sonata.data.18":{"sum":5065873,"min":0,"avg":4923.1030126336},"sonata.data.10":{"sum":4908078,"min":0,"avg":4998.0427698574},"sonata.data.1":{"sum":5139125,"min":0,"avg":5063.1773399015},"sonata.data.12":{"sum":5387653,"min":0,"avg":5225.657613967},"sonata.data.20":{"sum":4984527,"min":0,"avg":4935.1752475248},"sonata.data.19":{"sum":5038929,"min":0,"avg":4954.6991150442},"sonata.data.9":{"sum":4782475,"min":0,"avg":4850.3803245436},"sonata.data.6":{"sum":4944703,"min":0,"avg":4886.0701581028},"sonata.data.17":{"sum":4866245,"min":0,"avg":4980.8034800409},"sonata.data.2":{"sum":5215198,"min":0,"avg":5019.4398460058},"sonata.data.3":{"sum":5028502,"min":0,"avg":4915.4467253177},"sonata.data.5":{"sum":4841037,"min":0,"avg":4960.0788934426},"sonata.data.13":{"sum":4876932,"min":0,"avg":4986.6380368098},"sonata.data.11":{"sum":4799542,"min":0,"avg":4862.757852077},"sonata.data.15":{"sum":5014544,"min":0,"avg":5004.5349301397}}
```
