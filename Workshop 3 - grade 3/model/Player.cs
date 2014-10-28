using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack.model
{
    class Player : IObservable<Card>
    {
        private List<Card> m_hand = new List<Card>();
        private List<IObserver<Card>> observerList;

        
        public void DealCard(Card a_card)
        {
            m_hand.Add(a_card);

            foreach (var observer in observerList)
            {
                observer.OnNext(a_card);
            }

        }

        public Player()
        {
            observerList = new List<IObserver<Card>>();
        }

        public IDisposable Subscribe(IObserver<Card> observer)
        {
            if (!observerList.Contains(observer))
            {
                observerList.Add(observer);

                foreach (var item in m_hand)
                {
                    observer.OnNext(item);
                }
            }
            return new Unsubscriber<Card>(observerList, observer);
        }

        public IEnumerable<Card> GetHand()
        {
            return m_hand.Cast<Card>();
        }

        public void ClearHand()
        {
            m_hand.Clear();
        }

        public void ShowHand()
        {
            foreach (Card c in GetHand())
            {
                c.Show(true);
            }
        }


        public int CalcScore()
        {
            int[] cardScores = new int[(int)model.Card.Value.Count]
                {2, 3, 4, 5, 6, 7, 8, 9, 10, 10 ,10 ,10, 11};
            int score = 0;

            foreach(Card c in GetHand()) {
                if (c.GetValue() != Card.Value.Hidden)
                {
                    score += cardScores[(int)c.GetValue()];
                }
            }

            if (score > 21)
            {
                foreach (Card c in GetHand())
                {
                    if (c.GetValue() == Card.Value.Ace && score > 21)
                    {
                        score -= 10;
                    }
                }
            }

            return score;
        }


        public int SoftCalcScore()
        {
            int[] cardScores = new int[(int)model.Card.Value.Count] { 2, 3, 4, 5, 6, 7, 8, 9, 10, 10, 10, 10, 11 };
            int score = 0;

            foreach (Card c in GetHand())
            {
                if (c.GetValue() != Card.Value.Hidden)
                {
                    score += cardScores[(int)c.GetValue()];
                }
            }

            if (score > 21 || score == 17)
            {
                foreach (Card c in GetHand())
                {
                    if (c.GetValue() == Card.Value.Ace && (score > 21 || score == 17))
                    {
                        score -= 10;
                    }
                }
            }

            return score;
        }
    }
}
