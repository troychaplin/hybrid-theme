wp.blocks.registerBlockVariation('core/heading', {
  name: 'heading-highlighter',
  title: 'Heading Highlighter',
  description: 'A heading with custom background, link color, and font size.',
  attributes: {
      textColor: 'secondary',
      fontSize: 'large',
      style: {
          color: {
              background: '#fff2cd'
          },
          elements: {
              link: {
                  color: 'var:preset|color|secondary'
              }
          }
      }
  }
});

wp.blocks.registerBlockStyle('core/button', {
    name: 'green-button',
    label: 'Green',
});