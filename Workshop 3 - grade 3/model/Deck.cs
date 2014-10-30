using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack.model
{
    class Deck
    {

        List<Card> m_cards;     // En lista av kort (alltså kortleken).


        // Lägger till alla kort i kortleken för varje färg och för varje valör. Blandar.
        public Deck()
        {
            m_cards = new List<Card>();

            for (int colorIx = 0; colorIx < (int)Card.Color.Count; colorIx++)
            {
                for (int valueIx = 0; valueIx < (int)Card.Value.Count; valueIx++)
                {
                    Card c = new Card((Card.Color)colorIx, (Card.Value)valueIx);
                    AddCard(c);
                }
            }

            Shuffle();
        }



        public Card GetCard()
        {
            Card c = m_cards.First();
            m_cards.RemoveAt(0);
            return c;
        }


        // Lägger till ett kort till kortleken. Anropas i Deck().
        public void AddCard(Card a_c)
        {
            m_cards.Add(a_c);
        }


        // Kapslar in kortleken medhjälp av IEnumerables Cast-funktion? Innan den returneras.
        public IEnumerable<Card> GetCards()
        {
            return m_cards.Cast<Card>();
        }


        // Blandar korten i en slumpmässig ordning. 1017 är bara ett slumptal.
        private void Shuffle()
        {
            Random rnd = new Random();

            for (int i = 0; i < 1017; i++)
            {
                int index = rnd.Next() % m_cards.Count;
                Card c = m_cards.ElementAt(index);
                m_cards.RemoveAt(index);
                m_cards.Add(c);
            }
        }
    }
}
