# GW2 Embeddings (for Wordpress)

This is a WordPress extention impementrs some Shortcodes, to display GuildWars 2 ui-elements in articles.
It's based on [`discretize-ui`](https://github.com/discretize/discretize-ui).

# Cheatsheet

## Aura, Boon, Condition, Control

| attributes | value                       |
| ---------- | --------------------------- |
| name       | english effect-name         |
| notooltip  | deactivate Tooltip          |
| notext     | deactivate description text |
| nolink     | deactivate wiki-link        |
| noicon     | deactivate Icon             |
| size       | 'large' for a larger Icon   |
| inline     | use inline modifications    |
| style      | custom css properties       |

## Icon

| attributes | value                                      |
| ---------- | ------------------------------------------ |
| name       | icon name (ap, gems, karma, laurel, title) |
| text       | override default description text          |
| notooltip  | deactivate Tooltip                         |
| notext     | deactivate description text                |
| nolink     | deactivate wiki-link                       |
| noicon     | deactivate Icon                            |
| size       | 'large' for a larger Icon                  |
| inline     | use inline modifications                   |
| style      | custom css properties                      |

## coins

| attributes | value                     |
| ---------- | ------------------------- |
| value      | coin value as one number  |
| size       | 'large' for a larger Icon |
| inline     | use inline modifications  |
| style      | custom css properties     |

## items

| attributes | value                                                                          |
| ---------- | ------------------------------------------------------------------------------ |
| id         | item api-id(s) (semicolon separated)                                           |
| count      | number of stacked items                                                        |
| stats      | stats api id                                                                   |
| upgrades   | upgrade api id(s) (comma separeted. for stacked runes add +count e.g. 24815+3) |
| count      | for item-stacks (displays a number on the item-icon)                           |
| notooltip  | deactivate Tooltip                                                             |
| notext     | deactivate description text                                                    |
| nolink     | deactivate wiki-link                                                           |
| noicon     | deactivate Icon                                                                |
| size       | 'large' for a larger Icon                                                      |
| inline     | use inline modifications                                                       |
| style      | custom css properties                                                          |

### Multi-view

To view multiple items with different upgrades in one shortcode you have to use a special syntax.
Just like the item-ids are semicolon separated, the item-attributes have to be in the same string, separated with an semicolon ';'. In the same order as the ids.

## profession

| attributes | value                       |
| ---------- | --------------------------- |
| name       | english profession-name     |
| notooltip  | deactivate Tooltip          |
| notext     | deactivate description text |
| nolink     | deactivate wiki-link        |
| noicon     | deactivate Icon             |
| size       | 'large' for a larger Icon   |
| inline     | use inline modifications    |
| style      | custom css properties       |

## skills, specialisation, trait

| attributes | value                       |
| ---------- | --------------------------- |
| id         | api-id                      |
| notooltip  | deactivate Tooltip          |
| notext     | deactivate description text |
| nolink     | deactivate wiki-link        |
| noicon     | deactivate Icon             |
| size       | 'large' for a larger Icon   |
| inline     | use inline modifications    |
| style      | custom css properties       |

## traitline

| attributes | value                             |
| ---------- | --------------------------------- |
| id         | api-id                            |
| select     | ids of selected traits            |
| edit       | 'true' to make selection editable |
| inline     | use inline modifications          |
| style      | custom css properties             |
