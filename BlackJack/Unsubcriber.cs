using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack
{
    internal class Unsubscriber<Card> : IDisposable
    {
        private List<IObserver<Card>> _observers;
        private IObserver<Card> _observer;

        internal Unsubscriber(List<IObserver<Card>> observerList, IObserver<Card> observer)
        {
            this._observers = observerList;
            this._observer = observer;
        }

        public void Dispose()
        {
            if (_observers.Contains(_observer))
                _observers.Remove(_observer);
        }
    }
}
