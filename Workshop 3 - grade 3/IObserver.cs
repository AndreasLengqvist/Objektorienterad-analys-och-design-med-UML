using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack
{
    interface IObserver<T>
    {
        void OnNext(T value);
    }
}
