# gw2arm-embeds

This is a wordpress plugin to make it easier to use the [GW2 armory embeds](https://github.com/madou/armory-embeds)

# How it works

It adds the shortcode [gw2arm] to worpress. Supported attributes are:

- type (data-armory-embed)
- id (data-armory-ids)
- text (data-armory-inline-text)
- blank (data-armory-blank-text)
- traits (data-armory-[id]-traits)
- size (data-armory-size)
- inline (custom modification to view an embeding in line with text)

Options of the attributes are identical to the original. Just multi-specializations-view and skin/stat/upgrade additions are not implemented yet

# Example

You have to pick fitting options just like for the original embeddings
[gw2arm type='skills' id=5507 text=1 inline=1]

