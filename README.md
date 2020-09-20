# gw2arm-embeds

This is a wordpress plugin to make it easier to use the [GW2 armory embeds](https://github.com/madou/armory-embeds)

# How it works

It adds the shortcode [gw2arm] to worpress. Supported attributes are:

- type (data-armory-embed)
- id (data-armory-ids)
- text (data-armory-inline-text="wiki")
- traits (data-armory-[id]-traits)
- inline (custom modification to view an embeding in line with text)
- size (data-armory-size)

# Example

You have to pick fitting options just like for the original embeddings
[gw2arm type='skills' id=5507 text=1 inline=1]

# Issues
- Multiple IDs in one code untested. Especially multi specializations won't work
- blank text not implemented yet
- custom inline-text not implementet yet
