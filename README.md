# GW2 Embeddings (for Wordpress)


This is a Wordpress-plugin to make it easier to use the [`GW2 armory embeds`](https://github.com/madou/armory-embeds).
It adds the shortcodes `[gw2emb_amulets] [gw2emb_items] [gw2emb_skills] [gw2emb_specs] [gw2emb_traits]` to wordpress.
You have to fill in the attributes very similar to the original. See [`Armory-embeds-Storybook`](https://madou.github.io/armory-embeds) for detailed information.


# Cheatsheet

You have to add the needed options similar to the original GW2 Armory Embeddings.
Supported parameters are:

main attributes | value 
------------    |------------  
id              |  ID(s) to be viewed (e.g. skill-IDs)  
text            |  wiki (or gw2spidy)  
blank           |  any text 
size            |  number (for custom icon size in px) 
style           |  inline (mods the embed to be viewed inline with text)  

spec attributes |  value 
------------    |------------  
traits          |  trait IDs (read multi-view instructions) 

item attributes | value    
------------    |------------     
skin            |  skin ID   
stat            |  stat ID   
upgrades        |  upgrade IDs (for stacked runes add +count e.g. 24815+3) 
infusions       |  infusion ID 
count           |  for item-stacks (displays a number on the item-icon)



# Multi-view

To view multiple trait lines at once or multiple items with different upgrades you have to use a special syntax.
You can fill in the ids just as usual. But the selected traits or item-attributes have to be in the same string, separated with an semicolon ';'. In the same order as the ids.

## Examples:

### Specalizations

Two trait-lines with chosen traits:
```
Shortcode:
[gw2emb_specs  id=56,55  traits=2177,2061,2090; 2071,2085,2143 ]

Same shortcode with wrapped lines (to clarify the structure):
                        (Traitline 1)    (Traitline 2)
[gw2emb_specs     id  = 56             , 55
              traits  = 2177,2061,2090 ; 2071,2085,2143 ]
```

### Items
An item-stack of 10, with description text and inline with surrounding text
```
Shortcode:
[gw2emb_items id=9333 text=wiki style=inline count=10]

Same shortcode with wrapped lines (to clarify the structure):

[gw2emb_items id    = 9333 
              text  = wiki 
              style = inline 
              count = 10    ]
```

Three different equipment-items in one shortcode. First two with upgrades. The third with an infusion. (First two without infu):
```
Shortcode:
[gw2emb_items  id=1379,1378,1377  upgrades=24615;24615,24815+4  infusions=0; 0; 49426,49426 ]

Same shortcode with wrapped lines (to clarify the structure):
                        (Item 1)  (Item 2)        (Item 3)
[gw2emb_items     id  = 1379    , 1378          , 1377
            upgrades  = 24615   ; 24615,24815+4
           infusions  = 0       ; 0             ; 49426,49426 ]
```
